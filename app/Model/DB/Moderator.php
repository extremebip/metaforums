<?php

namespace App\Model\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Moderator extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'assigned_subcategory_id'
    ];
}
