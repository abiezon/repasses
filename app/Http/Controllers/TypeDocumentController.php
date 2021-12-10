<?php

namespace App\Http\Controllers;

use App\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TypeDocumentController extends Controller
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

        $type_documents = TypeDocument::latest()->paginate(5);
  
        return view('type-documents.index',compact('type_documents'))
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

        return view('type-documents.create');
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
            'status' => 'required'
        ]);
            
        TypeDocument::create([
            'description' => $request['description'],
            'status' => $request['status'] == 'on' ? true : false,
        ]);
   
        return redirect()->route('type-documents.index')
                        ->with('success', 'Tipo de Documento criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeDocument  $typeDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeDocument $type_document)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        return view('type-documents.create', compact('type_document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeDocument  $type_document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeDocument $type_document)
    {
        $type_document->description = $request->description;
        $type_document->status = $request->status == 'on' ? true : false;
        $type_document->save();

        return redirect()->route('type-documents.index')
                        ->with('success','Tipo de Documento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeDocument  $type_document
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeDocument $type_document)
    {
        if (!Gate::allows('isAdmin')) {
            return abort('403');
        }

        $type_document->delete();

        return redirect()->route('type-documents.index')
                        ->with('success','Tipo de Documento apagado com sucesso.');
    }
}
