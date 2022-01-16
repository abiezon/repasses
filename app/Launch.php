<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Launch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'type_document_id', 'date_document', 'doc_file'
    ];

    public function type_documents()
    {
        return  $this->belongsTo('App\TypeDocument');
    }

    public function hasTypeDocument($type_document_id)
    {        
        if (empty($type_document_id)) {
            return;
        }
        $type_document = TypeDocument::find($type_document_id);
        return $type_document->description;
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'launches_users', 'launch_id', 'user_id')->withTimestamps();
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'launches_groups', 'launch_id', 'group_id')->withTimestamps();
    }

    public function hasUser($launch_id)
    {        
        if (empty($launch_id)) {
            return;
        }
        
        $users_launch = LaunchUser::where('launch_id', $launch_id)->pluck('user_id')->toArray();
        
        if (empty($users_launch)) {
            return;
        }

        $users = User::whereIn('id', $users_launch)->get();

        $names = '';
        foreach ($users as $key => $user) {
            $names .= "{$user->name} - {$user->email} \n";
        }
        
        return nl2br(e($names), false);

    }

    public function hasGroup($launch_id)
    {        
        if (empty($launch_id)) {
            return;
        }
        $groups_launch = LaunchGroup::where('launch_id', $launch_id)->pluck('group_id')->toArray();

        if (empty($groups_launch)) {
            return ;
        }

        $groups = Group::whereIn('id', $groups_launch)->get();

        $names = '';
        foreach ($groups as $key => $group) {
            $names .= "{$group->cod_group} - {$group->description} \n";
        }

        return nl2br(e($names), false);
    }
}
