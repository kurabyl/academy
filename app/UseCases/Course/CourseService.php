<?php

namespace App\UseCases\Course;

use App\Entity\Course\Course;
use App\Entity\Course\VideoCourse;
use Illuminate\Support\Facades\File;

class CourseService
{

    public function create($request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('image_course'), $imageName);

        $course = Course::create([
            'title'=>$request->title,
            'section_id'=>$request->section,
            'description'=>$request->description,
            'image'=>$imageName,
            'lock'=>$request->lock
        ]);

        return $course;
    }

    public function edit($request)
    {
        $course = $this->getCourse($request->id);
        $course->title = $request->title;
        $course->description = $request->description;
        $course->section_id = $request->section;
        $course->lock = $request->lock ?  1 : 0;
        if($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('image_course'), $imageName);
            $course->image = $imageName;
            File::delete('image_course/'.$request->old_image);

        }else{
            $course->image = $request->old_image;
        }

        $course->save();

        return $course;
    }

    public function createVideo($request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('image_course'), $imageName);

        $course = VideoCourse::create([
            'title'=>$request->title,
            'section_id'=>$request->section,
            'course_id'=>$request->course,
            'video'=>$request->video,
            'description'=>$request->description,
            'image'=>$imageName
        ]);

        return $course;
    }

    public function editVideo($request)
    {
        $video = VideoCourse::findOrFail($request->id);

        $video->title = $request->title;
        $video->description = $request->description;
        $video->section_id = $request->section;
        $video->course_id = $request->course;
        $video->video  = $request->video;

        if($request->hasFile('image')) {

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('image_course'), $imageName);
            $video->image = $imageName;
            File::delete('image_course/'.$request->old_image);

        }else{
            $video->image = $request->old_image;
        }

        $video->save();

        return $video;
    }

    private function getCourse($id)
    {
        return Course::findOrFail($id);
    }
}
