<?php 

namespace App\Observers;

use App\Mail\LaunchMail;
use App\Launch;
use App\LaunchUser;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;

class LaunchObserver
{
    public $afterCommit = true;

    public function created(Launch $launch)
    {
       $this->sendEmail($launch);
    }

    public function updated(Launch $launch)
    {
        $this->sendEmail($launch);
    }

    public function sendEmail(Launch $launch)
    {    
        $user_list = [];

        $launchs_users = User::whereIn('id', request()->users)->get();        
        $launchs_groups = request()->groups;

        $launchs_group_users = User::whereIn('group_id', $launchs_groups)->get();

        if (count($launchs_users) > 0) {
            if (count($launchs_group_users) > 0) {
                $user_list = Arr::collapse($launchs_users, $launchs_group_users);
            } else {
                $user_list = $launchs_users;
            }
            
        } else if (count($launchs_group_users) > 0){
            $user_list = $launchs_group_users;
        } else {
            $user_list = User::all();
        }
        
        foreach ($user_list as $key => $user) {

            try {
                Mail::to($user->email)->send(new LaunchMail($launch));
            } catch (\Throwable $th) {
                return response($th->getMessage(), 422);
            }            
        }
        
    }

}

