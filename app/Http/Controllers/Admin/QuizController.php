<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\User;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        // Group quizzes by title and module_id, and get one quiz ID for each group
        $quizzes = Quiz::select('title', 'module_id', 
                DB::raw('COUNT(*) as question_count'), 
                DB::raw('MAX(created_at) as latest_created_at'),
                DB::raw('MIN(id) as id'), // Get the first quiz ID for each group
                DB::raw('MAX(is_published) as is_published') // Ambil status publish tertinggi
            )
            ->with('module')
            ->groupBy('title', 'module_id')
            ->orderBy('latest_created_at', 'desc')
            ->paginate(10);
            
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('admin.quizzes.create', compact('modules'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'module_id' => 'required|exists:modules,id',
                'title' => 'required|string|max:255',
                'is_published' => 'required|boolean',
                'questions' => 'required|array|min:1',
                'questions.*.question' => 'required|string',
                'questions.*.option_a' => 'required|string',
                'questions.*.option_b' => 'required|string',
                'questions.*.option_c' => 'required|string',
                'questions.*.option_d' => 'required|string',
                'questions.*.correct_answer' => 'required|in:a,b,c,d',
                'questions.*.explanation' => 'nullable|string'
            ]);

            \DB::beginTransaction();

            // Check if quiz with same title exists
            if (Quiz::where('title', $request->title)->where('module_id', $request->module_id)->exists()) {
                return back()->withErrors(['title' => 'Kuis dengan judul ini sudah ada untuk modul yang dipilih.'])->withInput();
            }

            foreach ($request->questions as $questionData) {
                Quiz::create([
                    'module_id' => $request->module_id,
                    'title' => $request->title,
                    'is_published' => $request->is_published,
                    'question' => $questionData['question'],
                    'option_a' => $questionData['option_a'],
                    'option_b' => $questionData['option_b'],
                    'option_c' => $questionData['option_c'],
                    'option_d' => $questionData['option_d'],
                    'correct_answer' => $questionData['correct_answer'],
                    'explanation' => $questionData['explanation'] ?? null
                ]);
            }

            // Update has_quiz flag on module
            $module = Module::find($request->module_id);
            $module->update(['has_quiz' => true]);

            // Send notifications if quiz is published
            if ($request->is_published) {
                // Get all users who have enabled quiz reminders
                $users = User::whereHas('notificationPreference', function($query) {
                    $query->where('quiz_reminders', true);
                })->get();

                // Send notification to each user
                foreach ($users as $user) {
                    NotificationController::sendNotification(
                        $user,
                        'quizzes',
                        "Kuis baru telah ditambahkan: {$request->title}",
                        [
                            'quiz_title' => $request->title,
                            'module_id' => $request->module_id,
                            'module_title' => $module->title
                        ]
                    );
                }
            }

            \DB::commit();

            return redirect()
                ->route('admin.quizzes.index')
                ->with('success', 'Kuis berhasil ditambahkan.');

        } catch (\Exception $e) {
            \DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan kuis. ' . $e->getMessage()])->withInput();
        }
    }

    public function edit(Quiz $quiz)
    {
        $modules = Module::all();
        // Get all questions with the same title and module_id
        $questions = Quiz::where('title', $quiz->title)
            ->where('module_id', $quiz->module_id)
            ->get();
            
        return view('admin.quizzes.edit', compact('quiz', 'modules', 'questions'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        try {
            $request->validate([
                'module_id' => 'required|exists:modules,id',
                'title' => 'required|string|max:255',
                'is_published' => 'required|boolean',
                'questions' => 'required|array|min:1',
                'questions.*.question' => 'required|string',
                'questions.*.option_a' => 'required|string',
                'questions.*.option_b' => 'required|string',
                'questions.*.option_c' => 'required|string',
                'questions.*.option_d' => 'required|string',
                'questions.*.correct_answer' => 'required|in:a,b,c,d',
                'questions.*.explanation' => 'nullable|string'
            ]);

            \DB::beginTransaction();

            // Check if quiz with new title exists (excluding current quiz)
            if ($request->title !== $quiz->title && 
                Quiz::where('title', $request->title)
                    ->where('module_id', $request->module_id)
                    ->exists()) {
                return back()->withErrors(['title' => 'Kuis dengan judul ini sudah ada untuk modul yang dipilih.'])->withInput();
            }

            // Delete all questions with the same title and module_id
            Quiz::where('title', $quiz->title)
                ->where('module_id', $quiz->module_id)
                ->delete();

            // Create new questions
            foreach ($request->questions as $questionData) {
                Quiz::create([
                    'module_id' => $request->module_id,
                    'title' => $request->title,
                    'is_published' => $request->is_published,
                    'question' => $questionData['question'],
                    'option_a' => $questionData['option_a'],
                    'option_b' => $questionData['option_b'],
                    'option_c' => $questionData['option_c'],
                    'option_d' => $questionData['option_d'],
                    'correct_answer' => $questionData['correct_answer'],
                    'explanation' => $questionData['explanation'] ?? null
                ]);
            }

            // Update has_quiz flag on module
            $module = Module::find($request->module_id);
            $module->update(['has_quiz' => true]);

            \DB::commit();

            return redirect()
                ->route('admin.quizzes.index')
                ->with('success', 'Kuis berhasil diperbarui.');

        } catch (\Exception $e) {
            \DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui kuis. ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy(Quiz $quiz)
    {
        $moduleId = $quiz->module_id;
        $title = $quiz->title;

        // Delete all questions with the same title and module_id
        Quiz::where('title', $title)
            ->where('module_id', $moduleId)
            ->delete();

        // Check if module still has any quizzes
        $hasOtherQuizzes = Quiz::where('module_id', $moduleId)->exists();
        if (!$hasOtherQuizzes) {
            Module::where('id', $moduleId)->update(['has_quiz' => false]);
        }

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Kuis berhasil dihapus.');
    }
} 