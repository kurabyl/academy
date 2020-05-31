<?php


namespace App\Http\Controllers\Course;

use App\Entity\Course\Activate;
use App\Entity\Course\Course;
use App\Entity\Course\CourseActivate;
use App\Entity\Course\VideoCourse;
use App\Http\Controllers\Controller;
use App\Jobs\Activition;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{

    public function list($id)
    {

        $course = $this->checkCourse($id);
        if($course) return redirect()->back()->with('warning','Бұл курс ақылы.');

        $listCourse = Course::findOrFail($id);
        return view('pages.list-course',['listCourse'=>$listCourse]);
    }

    public function more($id)
    {
        $more = VideoCourse::findOrFail($id);
        $course = $this->checkCourse($more->course_id);
        if($course) return redirect()->back()->with('warning','Бұл курс ақылы.');
        return view('pages.more-course',['more'=>$more]);
    }


    private function checkCourse($id)
    {

        $course = Course::findOrFail($id);

        if($course->lock == Course::LOCK_COURSE) {

            $activation = Activate::getUser($course->id,Auth::user()->id);
            if ($activation) {
                if(Activition::checkTime($activation->end) != true){
                    Activate::find($activation->id)->delete();
                    return true;
                }
                return false;
            }

            return true;
        }

        return false;
    }

}
