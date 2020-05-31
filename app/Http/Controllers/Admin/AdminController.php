<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Course\Course;
use App\Entity\Course\VideoCourse;
use App\Entity\Section;
use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\SectionRequest;
use App\UseCases\Section\SectionService;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    private $service;

    public function __construct(SectionService $service)
    {
        $this->middleware(['auth','role:admin']);
        $this->service = $service;
    }

    public function index()
    {

        return view('admin.main',[
            'users'=>User::all(),
            'section'=>Section::all(),
            'course'=>Course::all(),
            'video'=>VideoCourse::all()
        ]);
    }

    public function addSection(SectionRequest $request)
    {
        $section = $this->service->create($request);
        if($section)
            return redirect()->back()->with('success','Успешно добавлено');
    }

    public function editSection(SectionRequest $request)
    {
        $section = $this->service->edit($request);
        if($section)
            return redirect()->back()->with('success','Успешно изменено');
    }

}
