@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="row">
          <div class="col-10">
            <h2 >Cadastro de Grupos</h2>         
          </div>
          <div class="col-2">
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
      <div class="table-responsive">
        <table class="table table-striped">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Cod. Grupo</th>
                  <th>Nome do Grupo</th>
                  <th>Status</th>
                  <th width="280px">Ações</th>
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
          
                          <a class="btn btn-info" href="{{ route('groups.show',$group->id) }}">Mostrar</a>        
                          <a class="btn btn-primary" href="{{ route('groups.edit',$group->id) }}">Editar</a>
          
                          @csrf
                          @method('DELETE')
              
                          <button type="submit" class="btn btn-danger">Deletar</button>
                      </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
        </table>
      </div>
    </div>
    {!! $groups->links() !!}
    
@endsection