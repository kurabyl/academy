<?php


namespace App\Http\Controllers\Course;

use App\Entity\Application;
use App\Entity\Comment;
use App\Entity\Course\Activate;
use App\Entity\Course\Course;
use App\Entity\Course\CourseActivate;
use App\Entity\Course\VideoCourse;
use App\Entity\User\User;
use App\Entity\User\UserDetails;
use App\Entity\UserLog;
use App\Http\Controllers\Controller;
use App\Jobs\Activition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:student']);

        if(!request()->cookie('cookieName')) {
            Cookie::queue(Cookie::make('cookieName', md5(rand(99999,999999)), 3600000));
        }
    }

    public function list($id)
    {
        if(!$this->checkSession()) {
            Auth::logout();
        }

        $course = $this->checkCourse($id);
        if($course) return redirect()->back()->with('warning','Бұл курс ақылы.');

        $listCourse = Course::findOrFail($id);
        return view('pages.list-course',[
            'listCourse'=>$listCourse
        ]);
    }

    public function more($id)
    {
        if(!$this->checkSession()) {
            Auth::logout();
        }

        $more = VideoCourse::findOrFail($id);
        $comment = Comment::where('video_id',$id)->where('parent_id',0)->get();
        $course = $this->checkCourse($more->course_id);
        if($course) return redirect()->back()->with('warning','Бұл курс ақылы.');
        return view('pages.more-course',[
            'more'=>$more,
            'comment'=>$comment
        ]);
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

    public function buyCourse(Request $request)
    {
        $request->validate([
            'phone'=>'required|max:18'
        ]);
        UserDetails::where('user_id',Auth::user()->id)->update(['phone'=>$request->phone]);
        Application::create([
            'user_id'=>Auth::user()->id,
            'course_id'=>$request->course_id
        ]);
        return redirect()->back()->with('success','Рахмет сұраныс қабылданды');
    }

    public function addComment(Request $request)
    {
        $request->validate([
                'comment'=>'required'
        ]);
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->video_id= $request->id_video;
        $comment->text = $request->comment;
        $comment->save();
        return redirect()->back()->with('success','Пікір қалдырғаныңызға рахмет!');
    }

    private  function checkSession()
    {

        $userIp  = \request()->ip();
        $logExists = UserLog::where('user_id',Auth::user()->id);

        UserLog::create([
            'user_id'=>Auth::user()->id,
            'session'=>request()->cookie('cookieName'),
            'ip'=>$userIp,
        ]);

        if($logExists->first()->session != request()->cookie('cookieName')) {
            return false;
        }

        return true;

    }

}
