<?php

namespace App\Http\Controllers;

use App\Entity\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:student']);
    }

    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function buyCourse()
    {
        $userId = Auth::user()->id;
        $courseId = request()->course_id;

        $application = Application::where([
            'user_id'=>$userId,
            'course_id'=>$courseId
        ])->first();
        if(!$application)
        {
            Application::create([
                'user_id'=>$userId,
                'course_id'=>$courseId
            ]);

            return redirect()->back()->with('success','Рахмет! Сіздің сұранысыңыз қабылданды.Сізбен жақын арада хабарласамыз');
        }
        return redirect()->back()->with('warning','Упс! Сіз сұранысты '
            .$application->created_at.' күні жібердіңіз :) Осы номерге 877777777 хабарласыңыз');

    }
}
