<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleProgress extends Model
{
    protected $table = 'module_progress';
    
    protected $fillable = [
        'user_id',
        'module_id',
        'is_completed',
        'completed_at',
        'time_spent',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
        'time_spent' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
} 