<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        'gif_id',
        'alias',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
