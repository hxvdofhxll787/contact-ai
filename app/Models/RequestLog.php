<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'ip',
        'method',
        'url',
        'status_code',
        'request',
        'response',
        'duration_ms',
    ];

    protected $casts = [
        'request' => 'array',
        'response' => 'array',
    ];
}
