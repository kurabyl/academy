<?php


namespace App\Jobs;


class Activition
{
    const DATE = 'Y-m-d H:i:s';

    public static function checkTime($endTime)
    {
        $start = strtotime(date(self::DATE));
        if($start >= $endTime) {
            return false;
        }
        return true;
    }

    public static function createTime($time)
    {
        $time = $time == 20 ? '+20 minutes' : '+'.$time.' day';
        $time = date(self::DATE,strtotime($time));
        $time = strtotime($time);

        return $time;
    }
}
