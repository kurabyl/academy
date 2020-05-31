<?php

namespace App\Entity\Course;

use Illuminate\Database\Eloquent\Model;

class CourseActivate extends Model
{
    protected $table = 'course_activate';

    public static function getActivateId($courseId, $activateId)
    {
        return self::where([
            'course_id'=>$courseId,
            'activate_id'=>$activateId
        ])->first();
    }

}
