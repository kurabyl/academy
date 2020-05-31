<?php

namespace App\Entity\Course;

use App\Entity\Course\CourseActivate;
use Illuminate\Database\Eloquent\Model;

class Activate extends Model
{
    protected $table = 'activation';

    protected $fillable = ['user_id','course_id','end'];

    public function activate()
    {
        return $this->hasOne(CourseActivate::class,'activate_id');
    }

    public static function getUser($courseId,$userId)
    {
        return self::where([
            'course_id'=>$courseId,
            'user_id'=>$userId
        ])->first();
    }
}
