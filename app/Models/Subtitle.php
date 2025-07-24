<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'order',
        'is_published',
        'youtube_url'
    ];

    protected $casts = [
        'is_published' => 'boolean'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
