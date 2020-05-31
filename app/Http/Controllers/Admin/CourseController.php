<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\Section\SectionRequest;
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
}
