@extends('layouts.app')

@section('content')

<div class="col-12">

<h2 class="main-title">{{isset($launch) ? 'Editar' : 'Novo' }} Lançamentos</h2>

@if ($errors->any())
    <div class="row">
        <div class="col alert alert-danger">
            <strong>Opa!</strong> Houve alguns problemas com o seu cadastro.
        </div>
    </div>
@endif

        @if(isset($launch))
            <form action="{{ route('launches.update', $launch) }}" method="POST" enctype="multipart/form-data" class="form">
            @method('PUT')
        @else
            <form action="{{ route('launches.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @endif
        
            @csrf

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Título*:') }}</p>
                        <input type="text" class="form-input @error('description') is-invalid @enderror" name="description" placeholder="Descrição" value="{{ $launch->description ?? old('description') }}" required autofocus>
                        @if($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('description')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>

                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Tipo de Documento*:') }}</p>
                        <select name="type_document_id" id="type_documents" class="form-select" required>
                            <option value="" selected><-- Selecione uma opção --></option>
                            @foreach ($type_documents as $type_document)
                                <option value="{{$type_document->id}}" @if(isset($launch)){{ ($type_document->id == $launch->type_document_id) ? 'selected' : '' }}@endif>{{$type_document->description}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('type_document'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('type_document')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>

                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Arquivo*:') }}</p>
                        <input type="file" class="form-input @error('doc_file') is-invalid @enderror" name="doc_file" placeholder="Arquivo" value="{{ $launch->doc_file ?? old('doc_file') }}" {{$launch->doc_file ?? 'required' }} autofocus>
                        @if($errors->has('doc_file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('doc_file')}}</strong>
                        </span>
                        @endif
                    </label>
                    @if(isset($launch->doc_file))
                        <a href="{{ asset($url)}}" target="_blank" class="btn btn-outline-primary btn-block"><i data-feather="download" aria-hidden="true"></i> Download</a>
                    @endif
                </div>

                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Data*:') }}</p>
                        <input type="date" class="form-input @error('date_document') is-invalid @enderror" name="date_document" placeholder="Data do Documento" value="{{ $launch->date_document ?? old('date_document') }}" required autofocus>
                        @if($errors->has('date_document'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('date_document')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>

                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Usuário(s):') }}</p>
                        <select name="users[]" id="users" class="form-select" multiple>
                            <option value="" selected><-- Selecione uma opção --></option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}" @if(isset($launch)) @foreach($launch->users as $u) @if($user->id == $u->id)selected='selected'@endif @endforeach @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="row" style="margin-top: 1em;">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
</div>
@endsection