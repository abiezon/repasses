<?php 

namespace App\Observers;

use App\Mail\LaunchMail;
use App\Launch;
use App\LaunchUser;
use App\User;
use Illuminate\Support\Facades\Mail;

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

        $launchs_users = LaunchUser::whereRaw('launch_id', $launch->id)->get();
        
        $user_list = [];
        foreach ($launchs_users as $key => $launch_user) {
            $user = User::findOrFail($launch_user->user_id);

            try {
                Mail::to($user->email)->queue(new LaunchMail($launch));
            } catch (\Throwable $th) {
                return;
            }            
        }
        
    }

}

