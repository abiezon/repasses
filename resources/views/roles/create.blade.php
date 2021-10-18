@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-12 m-auto">
      <div class="row">
          <div class="col-10">
            <h2>{{isset($role) ? 'Editar' : 'Cadastrar' }} Perfil</h2>        
          </div>
          <div class="col-2">
            <a class="btn btn-danger" href="{{ route('roles.index') }}"> Voltar</a>
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
        @if(isset($role))
            <form action="{{ route('roles.update', $role) }}" method="POST">
            @method('PUT')
        @else
            <form action="{{ route('roles.store') }}" method="POST">
        @endif
        
            @csrf
        
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <strong>Nome do Perfil*:</strong>
                        <input type="text" name="description" class="form-control" placeholder="Nome do Perfil" value="{{$role->description ?? ''}}">
                        @if($errors->has('description'))
                            <span class="text-danger">*{{ $errors->first('description')}}</span>
                        @endif
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