<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id',
        'module_id',
        'score',
        'correct_answers',
        'total_questions',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'score' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public static function getLatestResult($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        return static::where('user_id', $userId)
            ->latest('completed_at')
            ->first();
    }

    public static function getAverageScore($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        return static::where('user_id', $userId)
            ->avg('score') ?? 0;
    }
} 