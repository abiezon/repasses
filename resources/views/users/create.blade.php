@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 m-auto">
      <div class="row">
          <div class="col-8">
            <h2>{{isset($user) ? 'Editar' : 'Cadastrar' }} Usuário</h2>        
          </div>
          <div class="col-4 text-right">
            <a class="btn btn-danger" href="{{ route('users.index') }}"> Voltar</a>
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
        @if(isset($user))
            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
        @else
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf  
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <strong>Name*:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{$user->name ?? ''}}">
                        @if($errors->has('name'))
                            <span class="text-danger">*{{ $errors->first('name')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Nome Completo:</strong>
                        <input type="text" name="full_name" class="form-control" placeholder="Nome Completo" value="{{$user->full_name ?? ''}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>E-mail*:</strong>
                        <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{$user->email ?? ''}}"></input>
                        @if($errors->has('email'))
                            <span class="text-danger">*{{ $errors->first('email')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Password*:</strong>
                        <input type="password" class="form-control" name="password" placeholder="Password" value="{{$user->password ?? ''}}"></input>
                        @if($errors->has('password'))
                            <span class="text-danger">*{{ $errors->first('password')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Data de Nascimento:</strong>
                        <input type="date" class="form-control" name="birth_date" placeholder="Data de Nascimento" value="@if(isset($user)) {{ date('Y-m-d', strtotime($user->birth_date)) ?? ''}}@endif"></input>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Foto*:</strong>
                        <input type="file" name="photo" class="form-control" placeholder="Foto" value="{{$user->photo ?? ''}}">
                        @if($errors->has('photo'))
                            <span class="text-danger">*{{ $errors->first('photo')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Grupo*:</strong>                
                        <select name="group_id" id="groups" class="form-control">
                            <option value="" selected></option>
                            @foreach ($groups as $group)
                                <option value="{{$group->id}}" @if(isset($user)){{ ($group->id == $user->group_id) ? 'selected' : '' }}@endif>{{$group->description}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('group_id'))
                            <span class="text-danger">*{{ $errors->first('group_id')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>Role*:</strong>                
                        <select name="role_id" id="roles" class="form-control">
                            <option value="" selected></option>
                            @foreach ($roles as $role)
                            <option value="{{$role->id}}" @if(isset($user)){{ ($role->id == $user->role_id) ? 'selected' : '' }}@endif>{{$role->description}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('role_id'))
                            <span class="text-danger">*{{ $errors->first('role_id')}}</span>
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group form-check">
                        <input type="checkbox" name="status" class="form-check-input" placeholder="Status" {{@$user->status ? 'checked="1"' : 'checked="0"'}}>
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