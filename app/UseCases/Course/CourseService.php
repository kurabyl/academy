<?php

namespace App\UseCases\Course;

use App\Entity\Course\Course;
use App\Entity\Course\DopVideo;
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
        if($request->lock == null)
        {
            $course->lock = 0;
        }else {
            $course->lock = 1;
        }

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
            'image'=>$imageName,
            'status'=>$request->lock
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

        if($request->lock == null)
        {
            $video->status = 0;
        }else {
            $video->status = 1;
        }

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

    public function createDopVideo($request)
    {
        $video = DopVideo::create([
            'title'=>$request->title,
            'video_id'=>$request->video_id,
            'video'=>$request->video,

        ]);

        return $video;
    }

    public function editDopVideo($request)
    {
        $video = DopVideo::findOrFail($request->id);

        $video->title = $request->title;
        $video->video_id = $request->video_id;
        $video->video  = $request->video;

        $video->save();

        return $video;
    }
}
