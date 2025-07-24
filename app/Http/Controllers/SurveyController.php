<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\SurveyResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $userResponses = SurveyResponse::where('user_id', Auth::id())
            ->get()
            ->keyBy('survey_id');

        return view('surveys.index', compact('surveys', 'userResponses'));
    }

    public function show(Survey $survey)
    {
        if (!$survey->is_published) {
            return redirect()->route('surveys.index')
                ->with('error', 'Survei ini belum dipublikasikan.');
        }

        $hasResponded = SurveyResponse::where('survey_id', $survey->id)
            ->where('user_id', Auth::id())
            ->exists();

        return view('surveys.show', compact('survey', 'hasResponded'));
    }

    public function submit(Request $request, Survey $survey)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
            'feedback' => 'nullable|string|max:1000'
        ]);

        // Check if user has already responded
        $hasResponded = SurveyResponse::where('survey_id', $survey->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($hasResponded) {
            return redirect()->route('surveys.show', $survey)
                ->with('error', 'Anda sudah mengisi survei ini.');
        }

        // Create survey response
        SurveyResponse::create([
            'survey_id' => $survey->id,
            'user_id' => $survey->is_anonymous ? null : Auth::id(),
            'answers' => $request->answers,
            'feedback' => $request->feedback
        ]);

        return redirect()->route('surveys.index')
            ->with('success', 'Terima kasih telah mengisi survei!');
    }

    public function results(Survey $survey)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('surveys.index')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $responses = $survey->responses()->with('user')->get();
        $responseCount = $survey->getResponseCount();
        $averageResponse = $survey->getAverageResponse();
        $responseDistribution = $survey->getResponseDistribution();

        return view('surveys.results', compact(
            'survey',
            'responses',
            'responseCount',
            'averageResponse',
            'responseDistribution'
        ));
    }
} 