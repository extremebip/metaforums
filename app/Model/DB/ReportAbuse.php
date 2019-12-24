<?php

namespace App\Model\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportAbuse extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reporting_user_id', 'reported_user_id', 'reason'
    ];
}
