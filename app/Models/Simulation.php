<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simulation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'scenario',
        'steps',
        'options',
        'correct_answers',
        'type',
        'is_published',
        'created_by'
    ];

    protected $casts = [
        'steps' => 'array',
        'options' => 'array',
        'correct_answers' => 'array',
        'is_published' => 'boolean'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function results()
    {
        return $this->hasMany(SimulationResult::class);
    }

    public function getLatestResult($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        return $this->results()
            ->where('user_id', $userId)
            ->latest()
            ->first();
    }

    public function getAverageScore($userId = null)
    {
        if (!$userId) {
            $userId = auth()->id();
        }

        return $this->results()
            ->where('user_id', $userId)
            ->avg('score') ?? 0;
    }
} 