@extends('layouts.app')

@section('content')

@can('isAdmin')
  <h2 class="main-title">Dados do usuário: {{$user->name}}</h2>
@else
  <h2 class="main-title">Meus dados</h2>
@endcan

  
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <div class="stat-cards-item users-table">
      <table class="table  posts-table table-stripedable">
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