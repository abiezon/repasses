<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
  
        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        $roles = Role::all();
        return view('users.create', compact('roles', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $message = Role::where('id', $request['role_id'])->value('description');    
        
        $message .= ' created succesfully.';

        $path = Storage::putFile('photos', $request->file('photo'));      

        User::create([
            'name' => $request['name'],
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role_id' => $request['role_id'],
            'group_id' => $request['group_id'],
            'photo' => $path,
            'birth_date' => $request['birth_date'],
            'status' => $request['status'] == 'on' ? true : false
        ]);
   
        return redirect()->route('users.index')
                        ->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $url = Storage::url($user->photo);
        return view('users.show', compact('user', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $groups = Group::all();
        $roles = Role::all();
        return view('users.create', compact('roles', 'groups', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {       
        $user->name = $request->name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role_id;
        $user->group_id = $request->group_id;

        if(!empty($request->file('photo'))) {
            $path = Storage::putFile('photos', $request->file('photo'));
            $user->photo = $path;
        }
        
        $user->birth_date = $request->birth_date;
        $user->status = $request->status == 'on' ? true : false;

        $user->save();  
        return redirect()->route('users.index')
                        ->with('success','User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function teachers()
    {   
        $title = 'Professores';
        $roleId = Role::where('description', 'Professor')->value('id');
        $users = User::where('role_id', $roleId)->paginate(5);  
        return view('users.index',compact('users', 'title'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function students()
    {
        $title = 'Alunos';
        $roleId = Role::where('description', 'Aluno')->value('id');    
        $users = User::where('role_id', $roleId)->paginate(5);  
        return view('users.index',compact('users', 'title'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
