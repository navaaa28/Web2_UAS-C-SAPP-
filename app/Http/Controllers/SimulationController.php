<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Models\SimulationResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function index()
    {
        $simulations = Simulation::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $userResults = SimulationResult::where('user_id', Auth::id())
            ->get()
            ->keyBy('simulation_id');

        return view('simulations.index', compact('simulations', 'userResults'));
    }

    public function show(Simulation $simulation)
    {
        if (!$simulation->is_published) {
            return redirect()->route('simulations.index')
                ->with('error', 'Simulasi ini belum dipublikasikan.');
        }

        $latestResult = $simulation->getLatestResult();

        return view('simulations.show', compact('simulation', 'latestResult'));
    }

    public function start(Simulation $simulation)
    {
        if (!$simulation->is_published) {
            return redirect()->route('simulations.index')
                ->with('error', 'Simulasi ini belum dipublikasikan.');
        }

        return view('simulations.play', compact('simulation'));
    }

    public function submit(Request $request, Simulation $simulation)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string'
        ]);

        $userAnswers = $request->answers;
        $correctAnswers = $simulation->correct_answers;
        $steps = $simulation->steps;
        $options = $simulation->options;

        $score = 0;
        $feedback = [];

        foreach ($steps as $index => $step) {
            $userAnswerIdx = isset($userAnswers[$index]) ? (int)$userAnswers[$index] : null;
            $correctAnswerIdx = isset($correctAnswers[$index]) ? (int)$correctAnswers[$index] : null;
            $userAnswerText = isset($options[$index][$userAnswerIdx]) ? $options[$index][$userAnswerIdx] : null;
            $correctAnswerText = isset($options[$index][$correctAnswerIdx]) ? $options[$index][$correctAnswerIdx] : null;

            if ($userAnswerIdx === $correctAnswerIdx) {
                $score += 100 / count($steps);
            }

            $feedback[] = [
                'step' => $step,
                'user_answer' => $userAnswerText,
                'correct_answer' => $correctAnswerText,
                'is_correct' => $userAnswerIdx === $correctAnswerIdx
            ];
        }

        $result = SimulationResult::create([
            'user_id' => Auth::id(),
            'simulation_id' => $simulation->id,
            'user_answers' => $userAnswers,
            'score' => round($score),
            'feedback' => json_encode($feedback),
            'completed_at' => now()
        ]);

        return redirect()->route('simulations.result', $result)
            ->with('success', 'Simulasi berhasil diselesaikan!');
    }

    public function result(SimulationResult $result)
    {
        if ($result->user_id !== Auth::id()) {
            return redirect()->route('simulations.index')
                ->with('error', 'Anda tidak memiliki akses ke hasil ini.');
        }

        return view('simulations.result', compact('result'));
    }
} 