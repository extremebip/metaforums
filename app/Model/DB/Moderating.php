<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moderating extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'moderating_type_id', 'thread_id', 'reason', 'post_id', 'time_end'
    ];

    protected $casts = [
        'time_end' => 'datetime'
    ];
}
