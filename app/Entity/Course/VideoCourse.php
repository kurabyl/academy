<?php


namespace App\Entity\Course;

use Illuminate\Database\Eloquent\Model;

use DB;

class VideoCourse extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'title', 'image','video','course_id','description','section_id'
    ];

    public function getDopVideo($id)
    {
        return DopVideo::find($id);
    }
    public function dvideo()
    {
        return $this->hasMany(DopVideo::class,'video_id');
    }

}
