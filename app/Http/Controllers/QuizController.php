<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Module;
use App\Models\QuizResult;
use App\Models\ModuleProgress;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        // Get all published modules that have quizzes
        $modules = Module::where('is_published', true)
            ->where('has_quiz', true)
            ->with(['quizzes' => function($query) {
                $query->select('module_id', \DB::raw('count(*) as question_count'))
                    ->groupBy('module_id');
            }])
            ->withCount('quizzes')
            ->orderBy('order')
            ->get();

        \Log::info('Modules:', $modules->toArray());

        // Get user's quiz results
        $currentUserId = Auth::id();
        \Log::info('Current User ID: ' . $currentUserId);
        
        $userResults = QuizResult::where('user_id', $currentUserId)
            ->get();
        
        \Log::info('User Results:', $userResults->toArray());
        
        $userResults = $userResults->keyBy('module_id');
        
        \Log::info('User Results Keyed:', $userResults->toArray());

        return view('quizzes.index', [
            'modules' => $modules,
            'userResults' => $userResults
        ]);
    }

    public function show($id)
    {
        // Cache module and questions for 60 minutes
        $module = Cache::remember('module_' . $id, 3600, function() use ($id) {
            return Module::findOrFail($id);
        });
        
        $questions = Cache::remember('quiz_questions_' . $id, 3600, function() use ($id) {
            return Quiz::where('module_id', $id)
                      ->where('is_published', true)
                      ->get();
        });
        
        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pertanyaan kuis untuk modul ini.');
        }

        // Store questions in session for submission
        session(['current_quiz_questions' => $questions]);

        return view('quizzes.show', [
            'module' => $module,
            'questions' => $questions
        ]);
    }

    public function submit(Request $request)
    {
        $moduleId = $request->input('module_id');
        $userAnswers = $request->except(['_token', 'module_id']);
        
        // Get questions from session instead of database
        $questions = session('current_quiz_questions');
        
        if (!$questions) {
            // Fallback to database if session expired
            $questions = Quiz::where('module_id', $moduleId)->get();
        }
        
        // Calculate score
        $totalQuestions = $questions->count();
        $correctAnswers = 0;
        $results = [];
        
        foreach ($questions as $question) {
            $userAnswer = $userAnswers['q' . $question->id] ?? null;
            $isCorrect = $userAnswer === $question->correct_answer;
            
            if ($isCorrect) {
                $correctAnswers++;
            }
            
            $results[] = [
                'question' => $question->question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'explanation' => $question->explanation,
                'options' => [
                    'a' => $question->option_a,
                    'b' => $question->option_b,
                    'c' => $question->option_c,
                    'd' => $question->option_d,
                ]
            ];
        }
        
        $score = ($correctAnswers / $totalQuestions) * 100;
        
        // Save quiz result to database
        QuizResult::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'module_id' => $moduleId
            ],
            [
                'score' => round($score, 2),
                'correct_answers' => $correctAnswers,
                'total_questions' => $totalQuestions,
                'completed_at' => now()
            ]
        );

        // Update module progress
        ModuleProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'module_id' => $moduleId
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
                'quiz_score' => round($score, 2)
            ]
        );

        // Check if module and quiz are completed with same title
        $module = Module::find($moduleId);
        $moduleProgress = ModuleProgress::where('user_id', Auth::id())
            ->where('module_id', $moduleId)
            ->where('is_completed', true)
            ->first();

        $quizResult = QuizResult::where('user_id', Auth::id())
            ->where('module_id', $moduleId)
            ->first();

        // If both module and quiz are completed, generate certificate
        if ($moduleProgress && $quizResult && $score >= 70) {
            // Check if certificate already exists
            $existingCertificate = Certificate::where('user_id', Auth::id())
                ->where('module_id', $moduleId)
                ->first();

            if (!$existingCertificate) {
                Certificate::create([
                    'user_id' => Auth::id(),
                    'module_id' => $moduleId,
                    'certificate_number' => Certificate::generateCertificateNumber(),
                    'title' => $module->title,
                    'score' => $score,
                    'issued_at' => now()
                ]);

                session()->flash('success', 'Selamat! Anda telah mendapatkan sertifikat untuk modul "' . $module->title . '".');
            }
        }
        
        // Store the results in the session
        $quizResults = [
            'module_id' => $moduleId,
            'score' => round($score, 2),
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions,
            'results' => $results
        ];
        
        session(['quiz_results' => $quizResults]);
        
        // Clear questions from session
        session()->forget('current_quiz_questions');
        
        return redirect()->route('quizzes.result');
    }

    public function result()
    {
        $results = session('quiz_results');
        
        if (!$results) {
            // Return a custom error view instead of redirecting
            return view('quizzes.error', [
                'message' => 'Halaman hasil kuis tidak dapat diakses secara langsung.',
                'description' => 'Untuk melihat hasil kuis, Anda harus mengerjakan kuis terlebih dahulu.',
                'action_link' => route('materials'),
                'action_text' => 'Lihat Daftar Materi'
            ]);
        }
        
        try {
            // Use cached module data if available
            $module = Cache::remember('module_' . $results['module_id'], 3600, function() use ($results) {
                return Module::findOrFail($results['module_id']);
            });
            
            return view('quizzes.result', [
                'module' => $module,
                'score' => $results['score'],
                'correctAnswers' => $results['correct_answers'],
                'totalQuestions' => $results['total_questions'],
                'results' => $results['results']
            ]);
        } catch (\Exception $e) {
            return view('quizzes.error', [
                'message' => 'Terjadi kesalahan saat memuat hasil kuis.',
                'description' => 'Silakan coba kembali mengerjakan kuis.',
                'action_link' => route('materials'),
                'action_text' => 'Lihat Daftar Materi'
            ]);
        } finally {
            // Clear the session data after displaying results
            session()->forget('quiz_results');
        }
    }
} 