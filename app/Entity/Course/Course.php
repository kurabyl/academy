<?php

namespace App\Entity\Course;

use App\Entity\VideoGroup;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    const LOCK_COURSE = 1; // if course not free

    protected $fillable = [
        'title', 'description','image','section_id'
    ];

    public function videos()
    {
        return $this->hasMany(VideoCourse::class);
    }

    public function activate()
    {
        return $this->hasOne(Activate::class);
    }


}
