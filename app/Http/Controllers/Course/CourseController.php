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
use App\Http\Controllers\Controller;
use App\Jobs\Activition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:student']);
    }

    public function list($id)
    {

        $course = $this->checkCourse($id);
        if($course) return redirect()->back()->with('warning','Бұл курс ақылы.');

        $listCourse = Course::findOrFail($id);
        return view('pages.list-course',[
            'listCourse'=>$listCourse
        ]);
    }

    public function more($id)
    {
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

}
