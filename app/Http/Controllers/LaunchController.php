<?php

namespace App\Http\Controllers;

use App\Launch;
use App\TypeDocument;
use App\LaunchUser;
use App\LaunchGroup;
use App\User;
use App\Role;
use App\Group;
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
    public function index(Request $request)
    { 
        if (Gate::allows('isAdmin')) {
            $type_document_ids = null;
            $dt_init = null;
            $dt_end = null;

            if ($request->has('search_type')) {
                $type_document_ids = TypeDocument::where('description', 'LIKE', '%' . $request->search_type . '%')->pluck('id')->toArray();
            }
            
            if ($request->has('search_dt_init') || $request->has('search_dt_end')) {
                $dt_init = $request->search_dt_init ?? '1970-01-01';
                $dt_end = $request->search_dt_end ?? '2100-12-31';
            }
            
            if (!empty($type_document_ids) || !empty($dt_init) || !empty($dt_end)) {
                $launchs = Launch::whereIn('type_document_id', $type_document_ids)->
                    whereBetween('date_document', [$dt_init, $dt_end])->paginate(25);
            } else {
                $launchs = Launch::latest()->paginate(25);
            }

            
        } else {
            $user_id = \Auth::user()->id;
            $lauchnsUsers = LaunchUser::where('user_id', $user_id)->pluck('launch_id')->toArray();
            $lauchnsGroups = LaunchGroup::where('group_id', \Auth::user()->group_id)->pluck('launch_id')->toArray();

            $type_document_ids = null;
            $dt_init = null;
            $dt_end = null;

            if ($request->has('search_type')) {
                $type_document_ids = TypeDocument::where('description', 'LIKE', '%' . $request->search_type . '%')->pluck('id')->toArray();
            }
            
            if ($request->has('search_dt_init') || $request->has('search_dt_end')) {
                $dt_init = $request->search_dt_init ?? '1970-01-01';
                $dt_end = $request->search_dt_end ?? '2100-12-31';
            }

            if (!empty($type_document_ids) || !empty($dt_init) || !empty($dt_end)) {
                $type_document_ids = TypeDocument::where('description', 'LIKE', '%' . $request->search_type . '%')->pluck('id')->toArray();

                $launchs = Launch::whereIn('id', $lauchnsUsers)->
                    orWhereIn('id', $lauchnsGroups)->
                    whereIn('type_document_id', $type_document_ids)->
                    whereBetween('date_document', [$dt_init, $dt_end])->paginate(25);

            } else {
                $launchs = Launch::whereIn('id', $lauchnsUsers)->
                orWhereIn('id', $lauchnsGroups)->paginate(25);
            }
        }
  
        return view('launches.index',compact('launchs'))
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

        $type_documents = TypeDocument::all();
        $role_ids = Role::where('description', '<>', 'Root')->pluck('id')->toArray();
        $users = User::whereIn('role_id', $role_ids)->get();
        $groups = Group::all();
        return view('launches.create', compact('type_documents', 'users', 'groups'));
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
        $insertUser->groups()->attach($request['groups']);
   
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

        $lauchnsUsers = LaunchUser::whereLaunchId($launch->id)->whereUserId(\Auth::user()->id)->count();
        $lauchnsGroups = LaunchGroup::whereLaunchId($launch->id)->whereGroupId(\Auth::user()->group_id)->count();

        if ($lauchnsUsers > 0 || $lauchnsGroups > 0 || Gate::allows('isAdmin')) {
            $url = Storage::url($launch->doc_file);
            return view('launches.show', compact('launch', 'url'));
        } else {
            return abort('403');
        }
        
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
        $groups = Group::all();
        $url = Storage::url($launch->doc_file);

        return view('launches.create', compact('launch', 'users', 'type_documents', 'url', 'groups'));
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request)
    { 
        if (Gate::allows('isAdmin')) {          

            return view('launches.reports');
            
        } else {
            return abort('403');
        }
  
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    { 
        if (Gate::allows('isAdmin')) {
            $type_document_ids = null;
            $dt_init = null;
            $dt_end = null;

            if ($request->has('search_type')) {
                $type_document_ids = TypeDocument::where('description', 'LIKE', '%' . $request->search_type . '%')->pluck('id')->toArray();
            }
            
            if ($request->has('search_dt_init') || $request->has('search_dt_end')) {
                $dt_init = $request->search_dt_init ?? '1970-01-01';
                $dt_end = $request->search_dt_end ?? '2100-12-31';
            }
            
            if (!empty($type_document_ids) || !empty($dt_init) || !empty($dt_end)) {
                $launchs = Launch::whereIn('type_document_id', $type_document_ids)->
                    whereBetween('date_document', [$dt_init, $dt_end])->paginate(25);
            } else {
                $launchs = Launch::latest()->paginate(25);
            }

            return view('launches.report',compact('launchs'))
            ->with('i', (request()->input('page', 1) - 1) * 25);
            
        } else {
            return abort('403');
        }
  
        
    }
}
