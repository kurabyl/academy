<?php

namespace App\Entity;

use App\Entity\User\User;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answer()
    {
        return $this->hasMany(self::class,'parent_id');
    }
}
