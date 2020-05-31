<?php

namespace App\Entity;

use App\Entity\Course\Course;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'application';

    protected $fillable = ['user_id','course_id'];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
