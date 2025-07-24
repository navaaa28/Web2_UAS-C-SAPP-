<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Models\ModuleProgress;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get module progress
        $modulesCompleted = ModuleProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();
        $totalModules = Module::count();
        
        // Get quiz progress
        $quizzesCompleted = QuizResult::where('user_id', $user->id)->count();
        $totalQuizzes = Quiz::count();
        
        // Calculate average score
        $averageScore = QuizResult::where('user_id', $user->id)
            ->avg('score') ?? 0;
            
        // Get last assessment date
        $lastAssessment = QuizResult::where('user_id', $user->id)
            ->latest()
            ->first();
        $lastAssessmentDate = $lastAssessment 
            ? Carbon::parse($lastAssessment->created_at)->diffForHumans()
            : 'Belum ada asesmen';

        $progressData = [
            'modules_completed' => $modulesCompleted,
            'total_modules' => $totalModules,
            'quizzes_completed' => $quizzesCompleted,
            'total_quizzes' => $totalQuizzes,
            'average_score' => round($averageScore),
            'last_assessment_date' => $lastAssessmentDate
        ];

        // Get assessment history for the last 6 months
        $assessmentHistory = $this->getAssessmentHistory($user->id);
        Log::info('Assessment History:', $assessmentHistory);

        // Get material recommendations based on performance
        $recommendations = $this->getRecommendations($user->id);
        Log::info('Recommendations:', $recommendations);

        return view('reports.index', compact('progressData', 'assessmentHistory', 'recommendations'));
    }

    private function getAssessmentHistory($userId)
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        
        $results = QuizResult::where('user_id', $userId)
            ->where('created_at', '>=', $sixMonthsAgo)
            ->orderBy('created_at')
            ->get();

        Log::info('Quiz Results:', ['count' => $results->count(), 'results' => $results->toArray()]);

        $labels = [];
        $scores = [];

        foreach ($results as $result) {
            $labels[] = Carbon::parse($result->created_at)->format('M');
            $scores[] = $result->score;
        }

        return [
            'labels' => $labels,
            'scores' => $scores
        ];
    }

    private function getRecommendations($userId)
    {
        // Get modules with low progress or not started
        $recommendations = [];
        
        $modules = Module::all();
        Log::info('All Modules:', ['count' => $modules->count(), 'modules' => $modules->toArray()]);
        
        foreach ($modules as $module) {
            $progress = ModuleProgress::where('user_id', $userId)
                ->where('module_id', $module->id)
                ->first();
                
            $progressPercentage = $progress ? ($progress->is_completed ? 100 : 50) : 0;
            
            if ($progressPercentage < 100) {
                $recommendations[] = [
                    'title' => $module->title ?? 'Modul ' . $module->id,
                    'description' => $module->description ?? 'Deskripsi tidak tersedia',
                    'progress' => $progressPercentage
                ];
            }
        }

        // Sort by progress (ascending) to show incomplete modules first
        usort($recommendations, function($a, $b) {
            return $a['progress'] <=> $b['progress'];
        });

        // Return top 3 recommendations
        return array_slice($recommendations, 0, 3);
    }
} 