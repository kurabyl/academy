<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class VideoGroup extends Model
{
    protected $table = 'video_groups';

    protected $fillable = ['group_id','video_id'];

}
