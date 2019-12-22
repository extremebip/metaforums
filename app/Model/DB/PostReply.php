<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReply extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'thread_id', 'reply_post_id', 'target_post_id'
    ];
}
