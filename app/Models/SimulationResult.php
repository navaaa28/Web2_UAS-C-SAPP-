<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'simulation_id',
        'user_answers',
        'score',
        'feedback',
        'completed_at'
    ];

    protected $casts = [
        'user_answers' => 'array',
        'completed_at' => 'datetime',
        'score' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function simulation()
    {
        return $this->belongsTo(Simulation::class);
    }
} 