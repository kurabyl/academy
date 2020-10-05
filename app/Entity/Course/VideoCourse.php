<?php


namespace App\Entity\Course;

use App\Entity\VideoGroup;
use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Support\Facades\Auth;

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

    public function groups($id)
    {
        return DB::table('video_groups')
            ->join('groups','groups.group_id','=','video_groups.group_id')
            ->where(['video_groups.video_id'=>$id])
            ->first();
    }

}
