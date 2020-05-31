<?php


namespace App\Jobs;


class Activition
{
    const DATE = 'Y-m-d H:i:s';

    public static function checkTime($endTime)
    {
        $start = strtotime(date(self::DATE));

        $endTimes = "+5 minutes";
        $end = date(self::DATE,strtotime($endTimes));
        $end = strtotime($end);
        if($start >= $endTime) {
            return false;
        }
        return true;
    }
}
