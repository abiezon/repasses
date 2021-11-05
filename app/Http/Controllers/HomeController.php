<?php

namespace App\Http\Controllers;

use App\Launch;
use App\TypeDocument;
use App\User;
use App\Role;
use App\Group;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $type_documents = TypeDocument::count();
        $users = User::count();
        $roles = Role::count();
        $groups = Group::count();
        $launches = Launch::count();
        return view('home', compact('type_documents', 'users', 'roles', 'groups', 'launches'));
    }
}
