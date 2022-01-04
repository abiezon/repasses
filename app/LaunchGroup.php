<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaunchGroup extends Model
{
    protected $table = 'launches_groups';

    protected $fillable = [
        'launch_id',
        'group_id'
    ];
}
