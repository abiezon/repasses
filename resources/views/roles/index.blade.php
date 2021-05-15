@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            <h2 >Cadastro de Perfis</h2>         
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
              <a class="btn btn-success" href="{{ route('roles.create') }}"> Novo</a>
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
                <th>Description</th>
                <th width="280px">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($roles as $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->description }}</td>
                
                <td>
                    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
        
                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>        
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
        
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
    {!! $roles->links() !!}
    
@endsection