<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'user_id',
        'module_id',
        'certificate_number',
        'title',
        'score',
        'issued_at'
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'score' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public static function generateCertificateNumber()
    {
        $prefix = 'CERT';
        $year = date('Y');
        $random = strtoupper(substr(uniqid(), -6));
        return $prefix . '-' . $year . '-' . $random;
    }
} 