<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Application;
use App\Entity\Course\Activate;
use App\Entity\Course\Course;
use App\Entity\Course\DopVideo;
use App\Entity\Course\VideoCourse;
use App\Entity\Group;
use App\Entity\Section;
use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function showSections()
    {
        return view('admin.show.section',['sections'=>Section::all()]);
    }

    public function showGroups()
    {
        return view('admin.show.groups',[
            'groups'=>Group::getGroups(),
            'users'=>User::where('role','student')->get()
        ]);
    }

    public function showGroup($id)
    {
        return view('admin.show.show-groups',[
            'group'=>Group::find($id),
            'groups'=>Group::getGroups(),
            'users'=>User::where('role','student')->get()
        ]);
    }

    public function showCourse()
    {
        return view('admin.show.course',[
            'course'=>Course::all(),
            'sections'=>Section::all()
        ]);
    }

    public function showStudents()
    {
        return view('admin.show.student',['users'=>User::where('role','student')->get()]);
    }

    public function editSections($id)
    {
        return view('admin.show.edit-section',['section'=>Section::findOrFail($id)]);
    }
    public function editGroups($id)
    {
        return view('admin.show.edit-groups',['groups'=>Group::findOrFail($id)]);
    }

    public function editCourse($id)
    {
        return view('admin.show.edit-course',[
            'course'=>Course::findOrFail($id),
            'sections'=>Section::all()
        ]);
    }

    public function showVideoCourse($id)
    {
        return view('admin.show.video-course', ['video'=>Course::findOrFail($id)]);
    }

    public function showAddVideoCourse()
    {
        return view('admin.show.add-videocourse',[
            'sections'=>Section::all(),
            'groups'=>Group::getGroups(),
            'video'=>VideoCourse::all(),

        ]);
    }

    public function editVideoCourse($id)
    {
        return view('admin.show.edit-videocourse',[
            'video'=>VideoCourse::findOrFail($id),
            'groups'=>Group::getGroups(),
            'sections'=>Section::all()
        ]);
    }

    public function showApplications()
    {
        return view('admin.show.applications',['users'=>User::where('role','student')->get()]);
    }

    public function showActiveApplications($id)
    {
        return view('admin.show.edit-application-active',[
            'application'=>Application::findOrFail($id),
        ]);
    }

    public function showDectiveApplications($id,$course_id)
    {
        Activate::where([
            'user_id'=>$id,
            'course_id'=>$course_id
        ])->delete();

        $status = Application::findOrfail(\request()->app);
        $status->status = 0;
        $status->save();

        return redirect()->back()->with('success','Успешно деактировано');
    }

    public function showDopVideo($id)
    {
        return view('admin.show.dop-video',[
            'video'=>DopVideo::where('video_id',$id)->get(),

        ]);
    }
    public function showEditDopVideo($id)
    {
        return view('admin.show.edit-dopvideo',[
            'videos'=>DopVideo::find($id),
            'video'=>VideoCourse::all(),
        ]);
    }
}
