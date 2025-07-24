<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleProgress;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Assessment;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get published modules
        $modules = Module::where('is_published', true)
            ->orderBy('order')
            ->get();

        // Get latest quizzes
        $latestQuizzes = Quiz::with('module')
            ->whereHas('module', function($query) {
                $query->where('is_published', true);
            })
            ->latest()
            ->take(3)
            ->get();

        // Calculate statistics
        $totalModules = $modules->count();
        $completedModules = ModuleProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();

        $moduleCompletionRate = $totalModules > 0 ? ($completedModules / $totalModules) * 100 : 0;

        $totalQuizModules = $modules->where('has_quiz', true)->count();
        $completedQuizzes = QuizResult::where('user_id', $user->id)
            ->distinct('module_id')
            ->count();
        
        $quizCompletionRate = $totalQuizModules > 0 ? ($completedQuizzes / $totalQuizModules) * 100 : 0;

        // Calculate total learning time (in hours)
        $totalTimeSpent = ModuleProgress::where('user_id', $user->id)
            ->sum('time_spent');
        $totalLearningTime = round($totalTimeSpent / 3600, 1); // Convert seconds to hours

        // Get achievements
        $achievements = $this->getAchievements($user->id);
        $unlockedAchievements = collect($achievements)->filter(function($achievement) {
            return $achievement['unlocked'];
        })->count();
        $totalAchievements = count($achievements);

        // Get progress overview data
        $progressOverview = [
            'labels' => [],
            'moduleData' => [],
            'quizData' => []
        ];

        // Get last 6 months of data
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $progressOverview['labels'][] = $date->format('M Y');

            // Get completed modules count for this month
            $moduleCount = ModuleProgress::where('user_id', $user->id)
                ->whereYear('completed_at', $date->year)
                ->whereMonth('completed_at', $date->month)
                ->where('is_completed', true)
                ->count();
            $progressOverview['moduleData'][] = $moduleCount;

            // Get completed quizzes count for this month
            $quizCount = QuizResult::where('user_id', $user->id)
                ->whereYear('completed_at', $date->year)
                ->whereMonth('completed_at', $date->month)
                ->count();
            $progressOverview['quizData'][] = $quizCount;
        }

        // Get latest assessment data
        $latestAssessment = QuizResult::where('user_id', $user->id)
            ->latest('completed_at')
            ->first();

        $assessmentData = [
            'score' => $latestAssessment ? round($latestAssessment->score) : 0,
            'completed_at' => $latestAssessment ? $latestAssessment->completed_at->diffForHumans() : null,
            'recommendations' => $this->getLearningRecommendations($user->id)
        ];

        // Get modules that are related to user's interests or unread
        $recommendations = Module::where('is_published', true)
            ->whereDoesntHave('progress', function($q) use ($user) {
                $q->where('user_id', $user->id)
                    ->where('is_completed', true);
            })
            ->latest()
            ->take(5)
            ->get();

        $assessmentData['recommendations'] = $recommendations->map(function($module) {
            return [
                'title' => $module->title,
                'description' => $module->description,
                'type' => $module->youtube_url ? 'video' : 'article',
                'icon' => $module->youtube_url ? 'fa-play-circle' : 'fa-book-reader',
                'link' => route('materials.module', $module)
            ];
        });

        // Get assessment data if exists
        if ($latestAssessment) {
            $assessmentData['level'] = $this->determineLevel($latestAssessment->score);
            $assessmentData['nextLevel'] = $this->determineNextLevel($assessmentData['level']);
            $assessmentData['progress'] = $this->calculateProgress($latestAssessment->score, $assessmentData['level']);
        }

        return view('dashboard', compact(
            'modules',
            'latestQuizzes',
            'completedModules',
            'totalModules',
            'moduleCompletionRate',
            'completedQuizzes',
            'totalQuizModules',
            'quizCompletionRate',
            'achievements',
            'unlockedAchievements',
            'totalAchievements',
            'totalLearningTime',
            'progressOverview',
            'assessmentData'
        ));
    }

    private function getAchievements($userId)
    {
        $user = User::find($userId);
        $completedModules = ModuleProgress::where('user_id', $userId)
            ->where('is_completed', true)
            ->count();
        
        $completedQuizzes = QuizResult::where('user_id', $userId)->count();
        $averageScore = QuizResult::where('user_id', $userId)->avg('score') ?? 0;
        $totalTimeSpent = ModuleProgress::where('user_id', $userId)->sum('time_spent');
        
        $achievements = [
            [
                'title' => 'Pemula Siber',
                'icon' => 'fa-graduation-cap',
                'description' => 'Menyelesaikan modul pertama',
                'unlocked' => $completedModules >= 1
            ],
            [
                'title' => 'Pembelajar Aktif',
                'icon' => 'fa-book-reader',
                'description' => 'Menghabiskan 1 jam belajar',
                'unlocked' => $totalTimeSpent >= 3600 // 1 hour in seconds
            ],
            [
                'title' => 'Mahir Kuis',
                'icon' => 'fa-star',
                'description' => 'Mendapatkan nilai rata-rata 80+',
                'unlocked' => $averageScore >= 80
            ],
            [
                'title' => 'Penguji Handal',
                'icon' => 'fa-tasks',
                'description' => 'Menyelesaikan 5 kuis',
                'unlocked' => $completedQuizzes >= 5
            ],
            [
                'title' => 'Ahli Keamanan',
                'icon' => 'fa-shield-alt',
                'description' => 'Menyelesaikan semua modul',
                'unlocked' => $completedModules >= Module::count()
            ],
            [
                'title' => 'Dedikasi Tinggi',
                'icon' => 'fa-clock',
                'description' => 'Menghabiskan 5 jam belajar',
                'unlocked' => $totalTimeSpent >= 18000 // 5 hours in seconds
            ],
            [
                'title' => 'Sempurna',
                'icon' => 'fa-crown',
                'description' => 'Mendapatkan nilai 100 di kuis',
                'unlocked' => QuizResult::where('user_id', $userId)->where('score', 100)->exists()
            ],
            [
                'title' => 'Master Siber',
                'icon' => 'fa-award',
                'description' => 'Menyelesaikan semua modul dengan nilai rata-rata 90+',
                'unlocked' => $completedModules >= Module::count() && $averageScore >= 90
            ]
        ];

        return $achievements;
    }

    private function getWeeklyProgress($userId)
    {
        $startDate = Carbon::now()->subWeeks(3)->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        
        $progress = [];
        $currentDate = $startDate;
        
        while ($currentDate <= $endDate) {
            $weekEnd = $currentDate->copy()->endOfWeek();
            
            $moduleProgress = ModuleProgress::where('user_id', $userId)
                ->whereBetween('completed_at', [$currentDate, $weekEnd])
                ->count();
                
            $quizProgress = ModuleProgress::where('user_id', $userId)
                ->whereNotNull('quiz_score')
                ->whereBetween('completed_at', [$currentDate, $weekEnd])
                ->count();
                
            $progress[] = [
                'week' => $currentDate->format('M d'),
                'module_progress' => $moduleProgress,
                'quiz_progress' => $quizProgress
            ];
            
            $currentDate->addWeek();
        }
        
        return $progress;
    }

    private function getAchievementTimeline($userId)
    {
        $timeline = [];
        
        // Get module completion achievements
        $moduleCompletions = ModuleProgress::where('user_id', $userId)
            ->whereNotNull('completed_at')
            ->orderBy('completed_at')
            ->get();
            
        foreach ($moduleCompletions as $completion) {
            $timeline[] = [
                'title' => 'Menyelesaikan Modul: ' . $completion->module->title,
                'date' => $completion->completed_at->format('d M Y')
            ];
        }
        
        // Get quiz achievements
        $quizCompletions = ModuleProgress::where('user_id', $userId)
            ->whereNotNull('quiz_score')
            ->orderBy('completed_at')
            ->get();
            
        foreach ($quizCompletions as $completion) {
            $timeline[] = [
                'title' => 'Menyelesaikan Kuis: ' . $completion->module->title,
                'date' => $completion->completed_at->format('d M Y')
            ];
        }
        
        // Sort timeline by date
        usort($timeline, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return array_slice($timeline, 0, 5); // Return only the 5 most recent achievements
    }

    private function getLearningRecommendations($userId)
    {
        // Get user's completed modules
        $completedModuleIds = ModuleProgress::where('user_id', $userId)
            ->where('is_completed', true)
            ->pluck('module_id');
        
        // Get unread modules
        $unreadModules = Module::where('is_published', true)
            ->whereNotIn('id', $completedModuleIds)
            ->orderBy('order')
            ->take(3)
            ->get();

        $recommendations = [];

        foreach ($unreadModules as $module) {
            $recommendations[] = [
                'type' => $module->youtube_url ? 'video' : 'article',
                'title' => $module->title,
                'description' => Str::limit($module->description, 100),
                'link' => route('materials.module', $module),
                'icon' => $module->youtube_url ? 'fa-play-circle' : 'fa-book-reader'
            ];
        }

        // If we have less than 3 recommendations, add completed modules that might need review
        if (count($recommendations) < 3) {
            $reviewModules = ModuleProgress::where('user_id', $userId)
                ->where('is_completed', true)
                ->whereHas('module', function($query) {
                    $query->where('is_published', true);
                })
                ->with('module')
                ->orderBy('completed_at', 'asc')
                ->take(3 - count($recommendations))
                ->get();

            foreach ($reviewModules as $progress) {
                $recommendations[] = [
                    'type' => $progress->module->youtube_url ? 'video' : 'article',
                    'title' => "Ulasan: " . $progress->module->title,
                    'description' => "Perkuat pemahaman Anda dengan mengulas materi ini kembali",
                    'link' => route('materials.module', $progress->module),
                    'icon' => $progress->module->youtube_url ? 'fa-play-circle' : 'fa-book-reader'
                ];
            }
        }

        return $recommendations;
    }

    private function determineLevel($score)
    {
        // Implement your logic to determine the level based on the score
        // This is a placeholder and should be replaced with the actual implementation
        return 'Level ' . (int)($score / 20 + 1);
    }

    private function determineNextLevel($currentLevel)
    {
        // Implement your logic to determine the next level
        // This is a placeholder and should be replaced with the actual implementation
        $level = (int)substr($currentLevel, 5);
        return 'Level ' . ($level + 1);
    }

    private function calculateProgress($score, $level)
    {
        // Implement your logic to calculate the progress percentage
        // This is a placeholder and should be replaced with the actual implementation
        $maxScore = 100;
        $levelScore = (int)substr($level, 5) * 20;
        return ($score / $maxScore) * 100;
    }
}