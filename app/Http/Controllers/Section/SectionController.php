<?php

namespace App\Http\Controllers\Section;

use App\Entity\Section;
use App\Http\Controllers\Controller;
use App\UseCases\Section\SectionService;

class SectionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','role:student']);
    }

    public function show($id)
    {
        $listCourse = Section::findOrfail($id);
        return view('pages.courses',['listCourse'=>$listCourse]);
    }

}
