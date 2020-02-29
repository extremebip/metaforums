<?php

namespace App\Helper\Time;

use Carbon\Carbon;

class TimeConverter
{
    public static function ToPastString($inputTime)
    {
        $time = null;

        if ($inputTime instanceof Carbon){
            $time = $inputTime->copy();
        }
        else {
            $time = new Carbon($inputTime, '+07:00');
        }

        if ($time->tzName != '+07:00')
            $time->tz = '+07:00';
            
        $now = Carbon::now('+07:00');
        if (($diff = $time->diffInYears($now)) > 0)
            return "$diff year(s) ago";
        else if (($diff = $time->diffInMonths($now)) > 0)
            return "$diff month(s) ago";
        else if (($diff = $time->diffInDays($now)) > 0)
            return "$diff day(s) ago";
        else if (($diff = $time->diffInHours($now)))
            return "$diff hours ago";
        else if (($diff = $time->diffInMinutes($now)) > 0)
            return $diff."m ago";
        else
            return "Moments ago";
    }
}
