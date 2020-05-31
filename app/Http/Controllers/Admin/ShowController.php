<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Course\Course;
use App\Entity\Course\VideoCourse;
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

        ]);
    }

    public function editVideoCourse($id)
    {
        return view('admin.show.edit-videocourse',[
            'video'=>VideoCourse::findOrFail($id),
            'sections'=>Section::all()
        ]);
    }
}
