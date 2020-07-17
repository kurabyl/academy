<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Application;
use App\Entity\Course\Activate;
use App\Entity\Course\Course;
use App\Entity\Course\DopVideo;
use App\Entity\Course\VideoCourse;
use App\Http\Controllers\Controller;
use App\Http\Requests\DopVideoRequest;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\Section\SectionRequest;
use App\Jobs\Activition;
use App\UseCases\Course\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $service;

    public function __construct(CourseService $service)
    {
        $this->middleware(['auth','role:admin']);
        $this->service = $service;
    }

    public function add(ImageRequest $request)
    {
        $course = $this->service->create($request);
        if($course)
            return redirect()->back()->with('success','Успешно добавлено');
    }

    public function edit(Request $request)
    {
        $section = $this->service->edit($request);
        if($section)
            return redirect()->back()->with('success','Успешно изменено');
    }

    public function delete($id)
    {
        $course = Course::find($id);
        if($course) {
            @unlink(public_path('image_course/'.$course->image));
            $video = VideoCourse::where('course_id',$course->id)->get();
            if($video->count() > 0)
            {
                foreach($video as $item)
                {
                    @unlink(public_path('image_course/'.$item->image));
                    VideoCourse::where('course_id',$course->id)->delete();
                }
            }
            $course->delete();
            return redirect()->back()->with('error','Успешно удалено');
        }
    }

    public function addVideo(ImageRequest $request)
    {
        $course = $this->service->createVideo($request);
        if($course)
            return redirect()->back()->with('success','Успешно добавлено');
    }

    public function editVideo(Request $request)
    {
        $section = $this->service->editVideo($request);
        if($section)
            return redirect()->back()->with('success','Успешно изменено');
    }

    public function activeCourse(Request $request)
    {
        $application = Application::findOrfail($request->id);
        $variants = Activition::createTime($request->variants);
        if(!Activate::where(['user_id'=>$application->user_id,'course_id'=>$application->course_id])->exists()){

            $activate = Activate::create([
                'user_id'=>$application->user_id,
                'course_id'=>$application->course_id,
                'end'=>$variants
            ]);
            if($activate) {
                $application->status = 1;
                $application->save();
                return redirect()->back()->with('success','Успешно активировано');
            }
        }
        return redirect()->back()->with('warning','Уже существует');
    }

    public function deleteVideo($id)
    {
        $video = VideoCourse::find($id);
        if($video) {
            @unlink(public_path('image_course/'.$video->image));
            $video->delete();
            return redirect()->back()->with('error','Успешно удалено');
        }
    }

    public function addDopVideo(DopVideoRequest $request)
    {
        $video = $this->service->createDopVideo($request);
        if($video)
            return redirect()->back()->with('success','Успешно добавлено');
    }

    public function editDopVideo(DopVideoRequest $request)
    {
        $video = $this->service->editDopVideo($request);
        if($video)
            return redirect()->back()->with('success','Успешно изменено');
    }

    public function deleteDopVideo($id)
    {
        $video = DopVideo::find($id);
        if($video) {
            $video->delete();
            return redirect()->back()->with('error','Успешно удалено');
        }
    }

}
