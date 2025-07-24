<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('admin.surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'purpose' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*.value' => 'required|string',
            'options.*.text' => 'required|string',
            'is_published' => 'required|boolean',
            'is_anonymous' => 'required|boolean'
        ]);

        Survey::create([
            'title' => $request->title,
            'description' => $request->description,
            'purpose' => $request->purpose,
            'questions' => $request->questions,
            'options' => $request->options,
            'is_published' => $request->is_published,
            'is_anonymous' => $request->is_anonymous,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('admin.surveys.index')
            ->with('success', 'Survei berhasil dibuat!');
    }

    public function edit(Survey $survey)
    {
        return view('admin.surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'purpose' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string',
            'options' => 'required|array|min:1',
            'options.*.value' => 'required|string',
            'options.*.text' => 'required|string',
            'is_published' => 'required|boolean',
            'is_anonymous' => 'required|boolean'
        ]);

        $survey->update([
            'title' => $request->title,
            'description' => $request->description,
            'purpose' => $request->purpose,
            'questions' => $request->questions,
            'options' => $request->options,
            'is_published' => $request->is_published,
            'is_anonymous' => $request->is_anonymous
        ]);

        return redirect()->route('admin.surveys.index')
            ->with('success', 'Survei berhasil diperbarui!');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();

        return redirect()->route('admin.surveys.index')
            ->with('success', 'Survei berhasil dihapus!');
    }
} 