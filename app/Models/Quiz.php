<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'explanation',
        'is_published'
    ];

    protected $casts = [
        'is_published' => 'integer',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function isCompletedByUser($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        return QuizResult::where('user_id', $userId)
            ->where('module_id', $this->module_id)
            ->exists();
    }
} 