@extends('layouts.app')

@section('content')

<h2 class="main-title">Lista de {{isset($title) ? $title : 'Usuários'}}</h2>
  
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="stat-cards-item users-table table-wrapper">
    <table class="table">
        <thead>
          <tr>
              <th>#</th>
              <th>Usuário</th>
              <th>E-mail</th>
              <th>Perfil</th>
              <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->hasRole($user->role_id) }}</td>
              <td>
                  <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                      <a class="btn btn-outline-secondary" href="{{ route('users.show',$user->id) }}">
                          <i data-feather="eye" aria-hidden="true"></i>
                      </a>
      
                      <a class="btn btn-outline-primary btn-block" href="{{ route('users.edit',$user->id) }}">
                        <i data-feather="edit" aria-hidden="true"></i>
                      </a>
      
                      @csrf
                      @method('DELETE')
          
                      <button type="submit" class="btn btn-outline-danger">
                          <i data-feather="trash" aria-hidden="true"></i>
                      </button>
                  </form>
              </td>
          </tr>
          @endforeach
        </tbody>          
    </table>
</div>
{!! $users->links() !!}
@endsection