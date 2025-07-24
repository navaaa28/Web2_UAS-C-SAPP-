<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Subtitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubtitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Module $module)
    {
        $subtitles = $module->subtitles()->paginate(10);
        return view('admin.subtitles.index', compact('module', 'subtitles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Module $module)
    {
        return view('admin.subtitles.create', compact('module'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Module $module)
    {
        try {
            // Log incoming request data
            Log::info('Creating subtitle with data:', [
                'request_data' => $request->all(),
                'module_id' => $module->id
            ]);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'order' => 'required|integer|min:0',
                'is_published' => 'required|boolean',
                'youtube_url' => 'nullable|url|max:255'
            ]);

            Log::info('Validated data:', [
                'validated' => $validated
            ]);

            $subtitle = new Subtitle($validated);
            $subtitle->module_id = $module->id;
            $subtitle->save();

            Log::info('Subtitle created successfully', [
                'subtitle_id' => $subtitle->id
            ]);

            return redirect()
                ->route('admin.modules.subtitles.index', $module)
                ->with('success', 'Sub judul berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Subtitle validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Subtitle creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan sub judul. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module, Subtitle $subtitle)
    {
        if ($subtitle->module_id !== $module->id) {
            abort(404);
        }
        return view('admin.subtitles.edit', compact('module', 'subtitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module, Subtitle $subtitle)
    {
        if ($subtitle->module_id !== $module->id) {
            abort(404);
        }

        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'order' => 'required|integer|min:0',
                'is_published' => 'required|boolean',
                'youtube_url' => 'nullable|url|max:255'
            ]);

            $subtitle->update($validated);

            return redirect()
                ->route('admin.modules.subtitles.index', $module)
                ->with('success', 'Sub judul berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Subtitle update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui sub judul. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module, Subtitle $subtitle)
    {
        if ($subtitle->module_id !== $module->id) {
            abort(404);
        }

        try {
            $subtitle->delete();

            return redirect()
                ->route('admin.modules.subtitles.index', $module)
                ->with('success', 'Sub judul berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Subtitle deletion failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->with('error', 'Gagal menghapus sub judul. Silakan coba lagi.');
        }
    }
}
