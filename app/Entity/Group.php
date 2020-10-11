<?php

namespace App\Entity;

use App\Entity\User\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class Group extends Model
{
    protected $fillable = ['title','group_id','user_id'];

    public static function getGroups()
    {
        return self::where(['group_id'=>0,'user_id'=>0])->get();
    }

    public static function checkUsers($groupId, int $key)
    {
        if (self::where(['group_id'=>$groupId,'user_id'=>$key])->exists())
            return false;
        return true;
    }

    public function countUsers($id)
    {
        return self::where('group_id',$id)->count();
    }

    public function users($id)
    {
        return DB::table('groups')
                ->join('users','users.id','=','groups.user_id')
                ->where('groups.group_id',$id)
                ->select('users.name','users.email','users.id')
                ->get();
    }

    public function videoGroup()
    {
        return $this->belongsTo(VideoGroup::class,'id','group_id')->where('video_id',request()->id);
    }
}
