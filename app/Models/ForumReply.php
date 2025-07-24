<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'user_id',
        'content',
        'is_solution'
    ];

    protected $casts = [
        'is_solution' => 'boolean'
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(ForumTopic::class, 'topic_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function markAsSolution(): void
    {
        // Unmark any existing solution
        $this->topic->replies()->where('is_solution', true)->update(['is_solution' => false]);
        
        // Mark this reply as solution
        $this->update(['is_solution' => true]);
    }
} 