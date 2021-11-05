@extends('layouts.app')

@section('content')
<div class="col-12">
    
<h2 class="main-title">{{isset($group) ? 'Editar' : 'Cadastrar' }} Grupo</h2>

@if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Opa!</strong> Houve alguns problemas com o seu cadastro.
        </div>
@endif 

    
        @if(isset($group))
            <form action="{{ route('groups.update', $group) }}" method="POST" class="form">
            @method('PUT')
        @else
            <form action="{{ route('groups.store') }}" method="POST" class="form">
        @endif
        
            @csrf
        
            <!-- <div class="row"> -->
                <div class="col-lg-9">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Código Grupo:') }}</p>
                        <input type="text" class="form-input @error('cod_group') is-invalid @enderror" name="cod_group" value="{{ $group->cod_group ?? old('cod_group') }}" required autofocus>
                        @if($errors->has('cod_group'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('cod_group')}}</strong>
                        </span>
                        @endif
                    </label>

                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Nome do Grupo:') }}</p>
                        <input type="text" class="form-input @error('description') is-invalid @enderror" name="description" value="{{ $group->description ?? old('description') }}" required>
                        @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('description')}}</strong>
                        </span>
                        @endif
                    </label>

                    <label class="form-checkbox-wrapper">
                        <input class="form-checkbox" type="checkbox" placeholder="Status" name="status" {{ @$group->status ? 'checked="1"' : 'checked="0"' }}>
                        <span class="form-checkbox-label">{{ __('Ativo') }}</span>
                        @if($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('status')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                
                <div class="col-lg-2 col-md-12 text-center">
                        <button type="submit" class="form-btn primary-default-btn transparent-btn">Salvar</button>
                </div>
            <!-- </div> -->
        
        </form>
    </div>
@endsection