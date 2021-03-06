<?php

namespace App\Model\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'subcategory_id', 'view_count'
    ];
}
