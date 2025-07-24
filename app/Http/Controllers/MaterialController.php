<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $modules = Module::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Total modul
        $totalModulesCount = $modules->count();
        // Modul selesai oleh user
        $completedModulesCount = 0;
        if ($user) {
            $completedModulesCount = \App\Models\ModuleProgress::where('user_id', $user->id)
                ->where('is_completed', true)
                ->whereIn('module_id', $modules->pluck('id'))
                ->count();
        }

        // Total kuis (modul yang punya kuis)
        $totalQuizzesCount = $modules->where('has_quiz', true)->count();
        // Kuis selesai oleh user (distinct module_id di QuizResult)
        $completedQuizzesCount = 0;
        if ($user) {
            $completedQuizzesCount = \App\Models\QuizResult::where('user_id', $user->id)
                ->whereIn('module_id', $modules->where('has_quiz', true)->pluck('id'))
                ->distinct('module_id')
                ->count('module_id');
        }

        // Total waktu belajar (dalam jam, dari time_spent di ModuleProgress)
        $totalLearningTime = 0;
        if ($user) {
            $totalSeconds = \App\Models\ModuleProgress::where('user_id', $user->id)
                ->sum('time_spent');
            $totalLearningTime = round($totalSeconds / 3600, 1); // 1 desimal
        }

        return view('materials.index', compact(
            'modules',
            'completedModulesCount',
            'totalModulesCount',
            'completedQuizzesCount',
            'totalQuizzesCount',
            'totalLearningTime'
        ));
    }

    public function showModule(Module $module)
    {
        $modules = Module::where('is_published', true)
            ->orderBy('created_at', 'asc')
            ->get();
            
        $currentIndex = $modules->search(function($item) use ($module) {
            return $item->id === $module->id;
        });
        
        $previousModule = $currentIndex > 0 ? $modules[$currentIndex - 1] : null;
        $nextModule = $currentIndex < $modules->count() - 1 ? $modules[$currentIndex + 1] : null;

        return view('materials.module', compact('module', 'modules', 'previousModule', 'nextModule'));
    }

    public function completeModule(Module $module)
    {
        ModuleProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'module_id' => $module->id,
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Modul berhasil diselesaikan!');
    }

    public function trackTime(Request $request, Module $module)
    {
        $timeSpent = $request->input('time_spent', 0);
        
        // Update or create module progress
        $progress = ModuleProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'module_id' => $module->id,
            ],
            [
                'time_spent' => DB::raw('time_spent + ' . $timeSpent),
            ]
        );

        return response()->json(['success' => true]);
    }
} 