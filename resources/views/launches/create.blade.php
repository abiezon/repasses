@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
      <div class="row">
          <div class="col-10">
            <h2>{{isset($launch) ? 'Editar' : 'Novo' }} Lançamento</h2>        
          </div>
          <div class="col-2">
            <a class="btn btn-danger" href="{{ route('launches.index') }}"> Voltar</a>
          </div>
      </div>      
  </div>
</div>
   
<hr>
<div class="clearfix"></div> 
@if ($errors->any())
    <div class="row">
        <div class="col alert alert-danger">
            <strong>Opa!</strong> Houve alguns problemas com o seu cadastro.
        </div>
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
                        <strong>Descrição*:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{$launch->description ?? ''}}">
                        @if($errors->has('description'))
                            <span class="text-danger">*{{ $errors->first('description')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Tipo de Documento*:</strong>                
                        <select name="type_document_id" id="type_documents" class="form-control select2-input">
                            <option value="" selected></option>
                            @foreach ($type_documents as $type_document)
                                <option value="{{$type_document->id}}" @if(isset($launch)){{ ($type_document->id == $launch->type_document_id) ? 'selected' : '' }}@endif>{{$type_document->description}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type_document_id'))
                            <span class="text-danger">*{{ $errors->first('type_document_id')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Arquivo*:</strong>
                        <input type="file" name="doc_file" class="form-control" placeholder="Arquivo" value="{{$launch->doc_file ?? ''}}">
                        @if($errors->has('doc_file'))
                            <span class="text-danger">*{{ $errors->first('doc_file')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Data do documento*:</strong>
                        <input type="date" class="form-control" name="date_document" placeholder="Data do Documento" value="{{$launch->date_document ?? ''}}"></input>
                        @if($errors->has('date_document'))
                            <span class="text-danger">*{{ $errors->first('date_document')}}</span>
                        @endif
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
                        <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        
        </form>
    </div>
</div>
@endsection