@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            <h2 >Cadastro de Grupos</h2>         
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
              <a class="btn btn-success" href="{{ route('groups.create') }}"> Novo</a>
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
                <th>Cod. Grupo</th>
                <th>Description</th>
                <th>Status</th>
                <th width="280px">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($groups as $group)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $group->cod_group }}</td>
                <td>{{ $group->description }}</td>
                <td>{{ $group->status == true ? 'Ativo' : 'Inativo' }}</td>
                
                <td>
                    <form action="{{ route('groups.destroy',$group->id) }}" method="POST">
        
                        <a class="btn btn-info" href="{{ route('groups.show',$group->id) }}">Show</a>        
                        <a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Edit</a>
        
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
    {!! $groups->links() !!}
    
@endsection