@extends('layouts.app')

@section('content')

<div class="col-12">

<h2 class="main-title">{{isset($group) ? 'Editar' : 'Cadastrar' }} Tipo de Documentos</h2> 


@if ($errors->any())
    <div class="row">
        <div class="col alert alert-danger">
            <strong>Opa!</strong> Houve alguns problemas com o seu cadastro.
        </div>
    </div>
@endif

        @if(isset($type_document))
            <form action="{{ route('type-documents.update', $type_document) }}" method="POST" class="form">
            @method('PUT')
        @else
            <form action="{{ route('type-documents.store') }}" method="POST" class="form">
        @endif
        
            @csrf
        
            <div class="col-lg-9">
                <label class="form-label-wrapper">
                    <p class="form-label">{{ __('Nome do Tipo de Documento*:') }}</p>
                    <input type="text" class="form-input @error('description') is-invalid @enderror" name="description" value="{{ $type_document->description ?? old('description') }}" required autofocus>
                    @if($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>*{{ $errors->first('description')}}</strong>
                    </span>
                    @endif
                </label>

                <label class="form-checkbox-wrapper">
                    <input class="form-checkbox" type="checkbox" placeholder="Status" name="status" {{ @$type_document->status ? 'checked="1"' : 'checked="0"' }}>
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
        </form>
</div>
@endsection