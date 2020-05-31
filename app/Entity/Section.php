<?php

namespace App\Entity;
use App\Entity\Course\Course;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'title', 'icon'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

}
