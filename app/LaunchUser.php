<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaunchUser extends Model
{
    protected $table = 'launches_users';

    protected $fillable = [
        'launch_id',
        'user_id'
    ];
}
