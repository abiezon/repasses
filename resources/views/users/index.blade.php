@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            <h2>Lista de {{isset($title) ? $title : 'Usuários'}}</h2>         
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
              <a class="btn btn-success" href="{{ route('users.create') }}"> Novo</a>
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
   
    <div class="col">
      <table class="table table-striped">
          <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>E-mail</th>
                <th>Perfil</th>
                <th width="280px">Action</th>
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
        
                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
        
                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        
                        @csrf
                        @method('DELETE')
            
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>          
      </table>
    </div>
    {!! $users->links() !!}
    
@endsection