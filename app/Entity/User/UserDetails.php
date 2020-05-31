<?php

namespace App\Entity\User;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
        'user_id', 'phone', 'gender','instagram','telegram'
    ];
}
