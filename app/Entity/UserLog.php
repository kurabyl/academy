<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $table = 'table_users_log';
    protected $fillable = ['user_id','ip','session'];
}
