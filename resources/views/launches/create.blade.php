@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-9 m-auto">
      <div class="col">
          <div class="float-left text-center col-8">
            <h2>{{isset($group) ? 'Editar' : 'Novo' }} Lançamento</h2>        
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('launches.index') }}"> Voltar</a>
          </div>
      </div>      
  </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 

<div class="row">
    <div class="col-9 m-auto">
        @if(isset($launch))
            <form action="{{ route('launches.update', $launch) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('launches.store') }}" method="POST" enctype="multipart/form-data">
        @endif
        
            @csrf
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{$launch->description ?? ''}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Tipo de Documento:</strong>                
                        <select name="type_document_id" id="type_documents" class="form-control select2-input">
                            <option value="" selected></option>
                            @foreach ($type_documents as $type_document)
                                <option value="{{$type_document->id}}" @if(isset($launch)){{ ($type_document->id == $launch->type_document_id) ? 'selected' : '' }}@endif>{{$type_document->description}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Arquivo:</strong>
                        <input type="file" name="doc_file" class="form-control" placeholder="Arquivo" value="{{$launch->doc_file ?? ''}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Data do documento:</strong>
                        <input type="date" class="form-control" name="date_document" placeholder="Data do Documento" value=" @if(isset($launch)){{ date('Y-m-d', strtotime(@$launch->date_document))}}else{{date('Y-m-d')}}@endif"></input>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Usuário(s):</strong>                
                        <select name="users[]" id="users" class="form-control" multiple>
                            <option value="" selected></option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" @if(isset($launch)) @foreach($launch->users as $u) @if($user->id == $u->id)selected='selected'@endif @endforeach @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-9 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        
        </form>
    </div>
</div>
@endsection