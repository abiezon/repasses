@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-9 m-auto">
      <div class="col">
          <div class="float-left text-center col-8">
            <h2>{{isset($group) ? 'Editar' : 'Cadastrar' }} Grupo</h2>        
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('groups.index') }}"> Voltar</a>
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
        @if(isset($group))
            <form action="{{ route('groups.update', $group) }}" method="POST">
            @method('PUT')
        @else
            <form action="{{ route('groups.store') }}" method="POST">
        @endif
        
            @csrf
        
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <strong>Código Grupo:</strong>
                        <input type="text" name="cod_group" class="form-control" placeholder="Código do Grupo" value="{{$group->cod_group ?? ''}}">
                        @if($errors->has('cod_group'))
                            <span class="text-danger">*{{ $errors->first('cod_group')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Nome do Grupo:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Nome do Grupo" value="{{$group->description ?? ''}}">
                        @if($errors->has('description'))
                            <span class="text-danger">*{{ $errors->first('description')}}</span>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" placeholder="Status" {{@$group->status ? 'checked="1"' : 'checked="0"'}}>
                        <label class="form-check-label"><strong>Ativo:</strong></label>
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