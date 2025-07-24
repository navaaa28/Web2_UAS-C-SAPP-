<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'purpose',
        'questions',
        'options',
        'is_published',
        'is_anonymous',
        'created_by'
    ];

    protected $casts = [
        'questions' => 'array',
        'options' => 'array',
        'is_published' => 'boolean',
        'is_anonymous' => 'boolean'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function responses()
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function getResponseCount()
    {
        return $this->responses()->count();
    }

    public function getAverageResponse()
    {
        return $this->responses()->avg('rating');
    }

    public function getResponseDistribution()
    {
        return $this->responses()
            ->selectRaw('answers, count(*) as count')
            ->groupBy('answers')
            ->get();
    }
} 