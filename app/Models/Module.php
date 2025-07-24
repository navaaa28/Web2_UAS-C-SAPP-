<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'content',
        'youtube_url',
        'order',
        'has_quiz',
        'is_published',
        'created_by'
    ];

    protected $casts = [
        'has_quiz' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function progress(): HasMany
    {
        return $this->hasMany(ModuleProgress::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function subtitles()
    {
        return $this->hasMany(Subtitle::class)->orderBy('order');
    }

    public function getUserProgressAttribute()
    {
        return $this->progress()
            ->where('user_id', Auth::id())
            ->first();
    }

    public function isCompletedByUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        return $this->progress()
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->exists();
    }

    public function getQuizStats($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        $result = QuizResult::where('user_id', $userId)
            ->where('module_id', $this->id)
            ->first();

        if (!$result) {
            return [
                'score' => 0,
                'correct_answers' => 0,
                'total_questions' => $this->quizzes()->count(),
                'completed_at' => null
            ];
        }

        return [
            'score' => $result->score,
            'correct_answers' => $result->correct_answers,
            'total_questions' => $result->total_questions,
            'completed_at' => $result->completed_at
        ];
    }
} 