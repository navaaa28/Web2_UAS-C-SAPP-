<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimulationController extends Controller
{
    public function index()
    {
        $simulations = Simulation::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.simulations.index', compact('simulations'));
    }

    public function create()
    {
        return view('admin.simulations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'steps' => 'required|array|min:1',
            'steps.*' => 'required|string',
            'correct_answers' => 'required|array|min:1',
            'correct_answers.*' => 'required|string',
            'is_published' => 'required|boolean'
        ]);

        Simulation::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'steps' => $request->steps,
            'correct_answers' => $request->correct_answers,
            'is_published' => $request->is_published,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('admin.simulations.index')
            ->with('success', 'Simulasi berhasil dibuat!');
    }

    public function edit(Simulation $simulation)
    {
        return view('admin.simulations.edit', compact('simulation'));
    }

    public function update(Request $request, Simulation $simulation)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'steps' => 'required|array|min:1',
            'steps.*' => 'required|string',
            'correct_answers' => 'required|array|min:1',
            'correct_answers.*' => 'required|string',
            'is_published' => 'required|boolean'
        ]);

        $simulation->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'steps' => $request->steps,
            'correct_answers' => $request->correct_answers,
            'is_published' => $request->is_published
        ]);

        return redirect()->route('admin.simulations.index')
            ->with('success', 'Simulasi berhasil diperbarui!');
    }

    public function destroy(Simulation $simulation)
    {
        $simulation->delete();

        return redirect()->route('admin.simulations.index')
            ->with('success', 'Simulasi berhasil dihapus!');
    }
} 