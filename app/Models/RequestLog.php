<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_name',
        'request_body',
        'http_status_code',
        'response_body',
        'origin_ip'
    ];

    protected $casts = [
        'request_body' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
