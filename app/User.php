<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'full_name', 'group_id', 'status', 'birth_date', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return  $this->belongsTo('App\Role');
    }

    public function groups()
    {
        return  $this->belongsTo('App\Group');
    }

    public function hasRole($role_id)
    {        
        if (empty($role_id)) {
            return;
        }
        $role = Role::find($role_id);
        return $role->description;
    }

    public function hasGroup($group_id)
    {        
        if (empty($group_id)) {
            return;
        }
        $group = Group::find($group_id);
        return $group->description;
    }

    public function launches()
    {
        return $this->belongsToMany('App\Launch');
    }

    public function teachers()
    {
        $roleId = Role::where('description', 'Professor')->value('id');
        $users = User::where('role_id', $roleId)->get(); 

        dd($users);
    }
}
