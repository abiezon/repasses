<?php

namespace App\Http\Controllers;

use App\Launch;
use App\TypeDocument;
use App\LaunchUser;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class LaunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if (Gate::allows('isAdmin')) {
            $launchs = Launch::latest()->paginate(5);
        } else {
            $user_id = \Auth::user()->id;
            $lauchnsUsers = LaunchUser::where('user_id', $user_id)->pluck('launch_id')->toArray();
            $launchs = Launch::whereIn('id', $lauchnsUsers)->paginate(5);
        }        
  
        return view('launches.index',compact('launchs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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

        $type_documents = TypeDocument::all();
        $role_ids = Role::where('description', '<>', 'Root')->pluck('id')->toArray();
        $users = User::whereIn('role_id', $role_ids)->get();
        return view('launches.create', compact('type_documents', 'users'));
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
            'description' => 'required',
            'type_document_id' => 'required',
            'date_document' => 'required',
            'doc_file' => 'required'
        ]);
        
        $path = Storage::putFile('files', $request->file('doc_file'));

        $insertUser = Launch::create([
            'description' => $request['description'],
            'type_document_id' => $request['type_document_id'],
            'date_document' => $request['date_document'],
            'doc_file' => $path
        ]);

        $insertUser->users()->attach($request['users']);        
   
        return redirect()->route('launches.index')
                        ->with('success', 'Lançamento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Launch  $launch
     * @return \Illuminate\Http\Response
     */
    public function show(Launch $launch)
    {
        $url = Storage::url($launch->doc_file);
        return view('launches.show', compact('launch', 'url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Launch  $launch
     * @return \Illuminate\Http\Response
     */
    public function edit(Launch $launch)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $type_documents = TypeDocument::all();
        $role_ids = Role::where('description', '<>', 'Root')->pluck('id')->toArray();
        $users = User::whereIn('role_id', $role_ids)->get();
        $url = Storage::url($launch->doc_file);

        return view('launches.create', compact('launch', 'users', 'type_documents', 'url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Launch  $launch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Launch $launch)
    {
        $launch->description = $request->description;
        $launch->type_document_id = $request->type_document_id;
        $launch->date_document = $request->date_document;

        if(!empty($request->file('doc_file'))) {
            $path = Storage::putFile('files', $request->file('doc_file'));
            $launch->doc_file = $path;
        }

        $launch->save();  
        return redirect()->route('launches.index')
                        ->with('success','Lançamento editado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Launch  $launch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Launch $launch)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }
        $launch->delete();

        return redirect()->route('launches.index')
                        ->with('success','Lançamento apagado com sucesso.');
    }
}
