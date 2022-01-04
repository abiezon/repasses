<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        if (Gate::allows('isSuperAdmin')) {
            $users = User::latest()->paginate(25);
        } else {
            $roles = Role::where('description', '<>', 'Root')->pluck('id')->toArray();

            if ($request->has('search_email')) {
                $users = User::whereIn('role_id', $roles)->
                    where('email', 'LIKE', '%' . $request->search_email . '%')->paginate(25);
            } else {
                $users = User::whereIn('role_id', $roles)->paginate(25);
            }
        }

        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $groups = Group::all();

        if (Gate::allows('isSuperAdmin')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('description', '<>', 'Root')->get();
        }
        
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
            'email' => 'required|unique:users',
            'password' => 'required',
            'photo' => 'required',
            'role_id' => 'required',
            'group_id' => 'required'
        ]);

        $message = Role::where('id', $request['role_id'])->value('description');    
        
        $message .= ' criado com sucesso.';

        
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
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $groups = Group::all();
        if (Gate::allows('isSuperAdmin')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('description', '<>', 'Root')->get();
        }
        $url = Storage::url($user->photo);

        return view('users.create', compact('roles', 'groups', 'user', 'url'));
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
                        ->with('success','Usuário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $user->delete();

       return redirect()->route('users.index')
                        ->with('success','Usuário apagado com sucesso.');
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
