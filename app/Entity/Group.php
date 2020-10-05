<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

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
}
