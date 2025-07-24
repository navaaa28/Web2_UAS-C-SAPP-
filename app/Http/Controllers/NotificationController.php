<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return back();
    }

    public function markAllAsRead()
    {
        Auth::user()->notifications()
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => now()
            ]);

        return back();
    }

    public static function sendNotification(User $user, string $type, string $message, array $data = [])
    {
        $preference = $user->notificationPreference;
        
        if (!$preference) {
            return;
        }

        $shouldNotify = match($type) {
            'progress' => $preference->progress_updates,
            'materials' => $preference->new_materials,
            'quizzes' => $preference->quiz_reminders,
            'security' => $preference->security_alerts,
            default => true
        };

        if ($shouldNotify) {
            $user->notifications()->create([
                'type' => $type,
                'message' => $message,
                'data' => $data
            ]);
        }
    }
}
