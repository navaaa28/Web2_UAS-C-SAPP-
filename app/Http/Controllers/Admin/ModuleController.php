<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('order')->paginate(10);
        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.modules.create');
    }

    public function store(Request $request)
    {
        try {
            // Debug raw request data
            Log::info('Raw request data:', [
                'all' => $request->all(),
                'is_published_input' => $request->input('is_published'),
                'has_is_published' => $request->has('is_published'),
                'boolean_is_published' => $request->boolean('is_published'),
                'checkbox_checked' => $request->has('is_published') && $request->input('is_published') == '1'
            ]);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'description' => 'required|string',
                'content' => 'required|string',
                'youtube_url' => 'nullable|url|max:255',
                'is_published' => 'required|in:0,1'
            ]);

            // Create module with validated data
            $module = new Module();
            $module->fill($validated);
            $module->created_by = Auth::id();
            
            Log::info('Creating module with data:', [
                'validated' => $validated
            ]);
            
            $module->save();

            // Send notifications if module is published
            if ($module->is_published) {
                // Get all users who have enabled new materials notifications
                $users = User::whereHas('notificationPreference', function($query) {
                    $query->where('new_materials', true);
                })->get();

                // Send notification to each user
                foreach ($users as $user) {
                    NotificationController::sendNotification(
                        $user,
                        'materials',
                        "Materi pembelajaran baru telah ditambahkan: {$module->title}",
                        [
                            'module_id' => $module->id,
                            'module_title' => $module->title,
                            'module_subtitle' => $module->subtitle
                        ]
                    );
                }
            }

            Log::info('Module created successfully', [
                'module_id' => $module->id
            ]);

            $status = $module->is_published ? 'dipublikasikan' : 'disimpan sebagai draft';
            return redirect()
                ->route('admin.modules.index')
                ->with('success', "Modul berhasil {$status}.");
        } catch (\Exception $e) {
            Log::error('Module creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal membuat modul. Silakan periksa data yang dimasukkan dan coba lagi.');
        }
    }

    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        try {
            // Debug raw request data
            Log::info('Raw request data in update:', [
                'all' => $request->all(),
                'is_published_input' => $request->input('is_published'),
                'has_is_published' => $request->has('is_published'),
                'boolean_is_published' => $request->boolean('is_published'),
                'checkbox_checked' => $request->has('is_published') && $request->input('is_published') == '1',
                'youtube_url' => $request->input('youtube_url')
            ]);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'description' => 'required|string',
                'content' => 'required|string',
                'youtube_url' => 'nullable|url|max:255',
                'is_published' => 'required|in:0,1'
            ]);

            // Update module with validated data
            $module->fill($validated);
            
            Log::info('Module before update:', [
                'id' => $module->id,
                'is_published' => $module->is_published
            ]);

            // Save changes
            $module->save();
            
            Log::info('Module after update:', [
                'id' => $module->id,
                'is_published' => $module->is_published,
                'fresh_is_published' => $module->fresh()->is_published,
                'youtube_url' => $module->youtube_url,
                'fresh_youtube_url' => $module->fresh()->youtube_url
            ]);

            $status = $module->is_published ? 'dipublikasikan' : 'disimpan sebagai draft';
            return redirect()
                ->route('admin.modules.index')
                ->with('success', "Modul berhasil {$status}.");
        } catch (\Exception $e) {
            Log::error('Module update failed', [
                'module_id' => $module->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui modul. Silakan periksa data yang dimasukkan dan coba lagi.');
        }
    }

    public function destroy(Module $module)
    {
        try {
            $module->delete();

            return redirect()
                ->route('admin.modules.index')
                ->with('success', 'Modul berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Module deletion failed', [
                'module_id' => $module->id,
                'error' => $e->getMessage()
            ]);

            return back()->withErrors(['error' => 'Gagal menghapus modul.']);
        }
    }
} 