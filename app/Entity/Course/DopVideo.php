<?php

namespace App\Entity\Course;

use Illuminate\Database\Eloquent\Model;

class DopVideo extends Model
{
    protected $table = 'dop_video';
    protected $fillable = ['title','video_id','video'];
}
