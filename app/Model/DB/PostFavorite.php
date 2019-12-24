<?php

namespace App\Model\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostFavorite extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'post_id'
    ];
}
