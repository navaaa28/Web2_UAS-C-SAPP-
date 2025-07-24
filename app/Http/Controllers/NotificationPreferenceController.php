<?php

namespace App\Http\Controllers;

use App\Models\NotificationPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationPreferenceController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Get or create notification preference
        $preferences = NotificationPreference::firstOrCreate(
            ['user_id' => $user->id],
            [
                'progress_updates' => false,
                'new_materials' => false,
                'quiz_reminders' => false,
                'security_alerts' => true,
                'frequency' => 'daily'
            ]
        );

        // Get notification values, defaulting to false if not checked
        $notifications = $request->input('notifications', []);
        
        // Update preferences
        $preferences->update([
            'progress_updates' => isset($notifications['progress']),
            'new_materials' => isset($notifications['materials']),
            'quiz_reminders' => isset($notifications['quizzes']),
            'security_alerts' => isset($notifications['security']),
            'frequency' => $request->input('frequency', 'daily')
        ]);

        // Log for debugging
        Log::info('Notification preferences updated', [
            'user_id' => $user->id,
            'preferences' => $preferences->toArray(),
            'request_data' => $request->all()
        ]);

        return back()->with('status', 'notifications-updated');
    }
}
