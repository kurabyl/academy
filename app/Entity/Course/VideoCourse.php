<?php


namespace App\Entity\Course;

use Illuminate\Database\Eloquent\Model;

use DB;

class VideoCourse extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'title', 'image','video','course_id','description'
    ];
}
