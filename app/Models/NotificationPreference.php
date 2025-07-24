<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationPreference extends Model
{
    protected $fillable = [
        'user_id',
        'progress_updates',
        'new_materials',
        'quiz_reminders',
        'security_alerts',
        'frequency'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
