@extends('layouts.app')

@section('content')

<div class="col-12">

<h2 class="main-title">{{isset($role) ? 'Editar' : 'Cadastrar' }} Perfil</h2>
 
@if ($errors->any())
    <div class="row">
        <div class="col alert alert-danger">
            <strong>Opa!</strong> Houve alguns problemas com o seu cadastro.
        </div>
    </div>
@endif

        @if(isset($role))
            <form action="{{ route('roles.update', $role) }}" method="POST" class="form">
            @method('PUT')
        @else
            <form action="{{ route('roles.store') }}" method="POST" class="form">
        @endif
        
            @csrf
        
            <div class="col-lg-9">
                <label class="form-label-wrapper">
                    <p class="form-label">{{ __('Nome do Perfil*:') }}</p>
                    <input type="text" class="form-input @error('description') is-invalid @enderror" name="description" value="{{ $role->description ?? old('description') }}" placeholder="Nome do Perfil" required autofocus>
                    @if($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>*{{ $errors->first('description')}}</strong>
                    </span>
                    @endif
                </label>
            </div>

            <div class="col-lg-2 col-md-12 text-center">
                <button type="submit" class="form-btn primary-default-btn transparent-btn">Salvar</button>
            </div>
        </form>
</div>
@endsection