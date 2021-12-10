@extends('layouts.app')

@section('content')

<div class="col-12">
    
<h2 class="main-title">{{isset($user) ? 'Editar' : 'Cadastrar' }} Usuário</h2>

@if ($errors->any())
    <div class="col alert alert-danger">
        <strong>Opa!</strong> Houve alguns problemas com o seu cadastro.
    </div>
@endif
   
        @if(isset($user))
            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="form">
            @method('PUT')
        @else
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @endif
            @csrf  
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Nome*:') }}</p>
                        <input type="text" class="form-input @error('name') is-invalid @enderror" name="name" placeholder="Primeiro nome" value="{{ $user->name ?? old('name') }}" required autofocus>
                        @if($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('name')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Nome Completo*:') }}</p>
                        <input type="text" class="form-input @error('full_name') is-invalid @enderror" name="full_name" placeholder="Nome completo" value="{{ $user->full_name ?? old('full_name') }}" required autofocus>
                        @if($errors->has('full_name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('full_name')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('E-mail*:') }}</p>
                        <input type="email" class="form-input @error('email') is-invalid @enderror" name="email" placeholder="Seu melhor e-mail" value="{{ $user->email ?? old('email') }}" required autofocus>
                        @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('email')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Senha*:') }}</p>
                        <input type="password" class="form-input @error('password') is-invalid @enderror" name="password" placeholder="Informe sua senha" value="{{ $user->password ?? old('password') }}" required autofocus>
                        @if($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('password')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Data de Nascimento:') }}</p>
                        <input type="date" class="form-input @error('birth_date') is-invalid @enderror" name="birth_date" placeholder="Data de nascimento" value="{{ date('Y-m-d', strtotime(@$user->birth_date)) ?? old('birth_date') }}">
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Foto*:') }}</p>
                        <input type="file" class="form-input @error('photo') is-invalid @enderror" name="photo" placeholder="Foto" value="{{ $user->photo ?? old('photo') }}" {{$user->photo ?? 'required'}} autofocus>
                        @if($errors->has('photo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('photo')}}</strong>
                        </span>
                        @endif
                    </label>
                    @if(isset($user->photo))
                        <span class="nav-user-img">
                            <label for="">Foto atual
                                <picture><source srcset="{{ asset($url)}}" type="image/webp"><img src="{{ asset($url)}}" alt="User name" class="rounded-circle" width='30%'></picture>
                            </label>
                        </span>
                    @endif
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Grupo*:') }}</p>
                        <select name="group_id" id="groups" class="form-select" required>
                            <option value="" selected><-- Selecione uma opção --></option>
                            @foreach ($groups as $group)
                                <option value="{{$group->id}}" @if(isset($user)){{ ($group->id == $user->group_id) ? 'selected' : '' }}@endif>{{$group->description}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('group_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('group_id')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label class="form-label-wrapper">
                        <p class="form-label">{{ __('Perfil*:') }}</p>
                        <select name="role_id" id="roles" class="form-select" required>
                            <option value="" selected><-- Selecione uma opção --></option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}" @if(isset($user)){{ ($role->id == $user->role_id) ? 'selected' : '' }}@endif>{{$role->description}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>*{{ $errors->first('role_id')}}</strong>
                        </span>
                        @endif
                    </label>
                </div>
                <div class="col-lg-6 col-md-12">
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

                <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div> 
        </form>
</div>
@endsection