@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12 m-auto">
      <div class="row">
          <div class="col-10">
            <h2>{{isset($group) ? 'Editar' : 'Cadastrar' }} Tipo de Documentos</h2>        
          </div>
          <div class="col-2">
            <a class="btn btn-danger" href="{{ route('type-documents.index') }}"> Voltar</a>
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
    <div class="col-12 m-auto">
        @if(isset($type_document))
            <form action="{{ route('type-documents.update', $type_document) }}" method="POST">
            @method('PUT')
        @else
            <form action="{{ route('type-documents.store') }}" method="POST">
        @endif
        
            @csrf
        
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <strong>Nome do Tipo de Documento*:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Informe o nome do Tipo de Documento" value="{{$type_document->description ?? ''}}">
                        @if($errors->has('description'))
                            <span class="text-danger">*{{ $errors->first('description')}}</span>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" placeholder="Status" {{@$type_document->status ? 'checked="1"' : 'checked="0"'}}>
                        <label class="form-check-label"><strong>Ativo:</strong></label>
                    </div>
                </div>
                
                <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        
        </form>
    </div>
</div>
@endsection