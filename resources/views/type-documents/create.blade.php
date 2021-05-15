@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-9 m-auto">
      <div class="col">
          <div class="float-left text-center col-8">
            <h2>{{isset($group) ? 'Editar' : 'Cadastrar' }} Tipo de Documentos</h2>        
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('type-documents.index') }}"> Voltar</a>
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
        @if(isset($type_document))
            <form action="{{ route('type-documents.update', $type_document) }}" method="POST">
            @method('PUT')
        @else
            <form action="{{ route('type-documents.store') }}" method="POST">
        @endif
        
            @csrf
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Descrição" value="{{$type_document->description ?? ''}}">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" placeholder="Status" {{@$type_document->status ? 'checked="1"' : 'checked="0"'}}>
                        <label class="form-check-label"><strong>Ativo:</strong></label>
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