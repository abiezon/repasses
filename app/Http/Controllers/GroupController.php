<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $groups = Group::latest()->paginate(5);
  
        return view('groups.index',compact('groups'))
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

        return view('groups.create');
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
            'cod_group' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
            
        Group::create([
            'cod_group' => $request['cod_group'],
            'description' => $request['description'],
            'status' => $request['status'] == 'on' ? true : false,
        ]);
   
        return redirect()->route('groups.index')
                        ->with('success', 'Grupo criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $Group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        return view('groups.create', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $group->cod_group = $request->cod_group;
        $group->description = $request->description;
        $group->status = $request->status == 'on' ? true : false;
        $group->save();  
        return redirect()->route('groups.index')
                        ->with('success','Grupo atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $group->delete();

        return redirect()->route('groups.index')
                        ->with('success','Grupo apagado com sucesso.');

    }
}