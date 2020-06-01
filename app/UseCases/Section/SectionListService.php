<?php

namespace App\UseCases\Section;
use App\Entity\Course\Course;
use App\Entity\Section;
use Illuminate\Support\Facades\Auth;
use DB;
class SectionListService
{
    public static function get()
    {
        return Section::all();
    }

    public static function listCourse($id)
    {
        return Course::where('section_id',$id)->get();
    }

    public static function mycourse()
    {
        if(Auth::check())
            return DB::table('activation')
            ->where('user_id',Auth::user()->id)
            ->join('course','activation.course_id','=','course.id')
            ->count();
    }
}
