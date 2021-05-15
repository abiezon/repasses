@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            @can('isAdmin')
              <h2>Dados do usuário: {{$user->name}}</h2>
            @else
              <h2>Meus dados</h2>
            @endcan         
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
            @can('isAdmin')
              <a class="btn btn-primary" href="{{ route('users.edit', $user) }}"> Editar</a>
            @endcan
          </div>
      </div>      
  </div>
  <div class="clearfix"></div>
  <hr>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <div class="clearfix"></div>
    <div class="col m-auto">
      <table class="table">
        <thead class="thead-dark">
            <th colspan="2">&nbsp;</th>
        </thead>
        <tbody>
          <tr>
            <td>Nome:</td>
            <td>{{ $user->name }}</td>
          </tr>
          <tr>
            <td>Nome Completo:</td>
            <td>{{ $user->full_name }}</td>
          </tr>
          <tr>
            <td>Data de Nascimento:</td>
            <td>{{ date('d/m/Y', strtotime($user->birth_date)) }}</td>
          </tr>
          <tr>
            <td>E-mail:</td>
            <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <td>Grupo:</td>
            <td>{{ $user->hasGroup($user->group_id) }}</td>
          </tr>
          <tr>
            <td>Perfil:</td>
            <td>{{ $user->hasRole($user->role_id) }}</td>
          </tr>
          <tr>
            <td>Status:</td>
            <td>{{ $user->status == true ? 'Ativo' : 'Inativo' }}</td>
          </tr>
          <tr>
            <td>Foto:</td>
            <td><img src="{{ asset($url)}}" width="80" height="100"/></td>
          </tr>
        </tbody>
      </table>
    </div>
    
    
@endsection