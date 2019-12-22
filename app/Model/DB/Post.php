<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'content', 'is_thread'
    ];

    protected $casts = [
        'is_thread' => 'boolean'
    ];
}
