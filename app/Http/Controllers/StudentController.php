<?php

namespace App\Http\Controllers;

use App\Entity\Application;
use App\Entity\User\User;
use App\Entity\User\UserDetails;
use App\Entity\UserLog;
use App\UseCases\Section\SectionListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:student']);
    }

    public function index()
    {
        $user = User::find(Auth::id());
        
        return view('home',[
            'user'=>$user
        ]);
    }

    public function profile()
    {
        return view('profile',['user'=>Auth::user()]);
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
            .$application->created_at.' күні жібердіңіз ');

    }

    public function changeDetails(Request $request)
    {

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;

        if ($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $details = UserDetails::where('user_id',$user->id)->first();
        $details->gender = $request->gender;
        $details->phone = $request->phone;
        $details->birthday = $request->date;
        $details->telegram = $request->telegram;
        $details->instagram = $request->instagram;

        $details->save();
        return redirect()->back()->with('success','Өзгертілді');
    }

    public function myCourse()
    {
        return view('pages.mycourse',[
            'listCourse'=>SectionListService::mycourse()->get()
        ]);
    }
}
