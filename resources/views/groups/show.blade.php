@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            <h2>Ver Grupos</h2>       
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
            @can('isAdmin')
              <a class="btn btn-primary" href="{{ route('groups.edit', $group) }}"> Editar</a>
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
            <td>Código do Grupo:</td>
            <td>{{ $group->cod_group }}</td>
          </tr>
          <tr>
            <td>Nome do Grupo:</td>
            <td>{{ $group->description }}</td>
          </tr>
          <tr>
            <td>Status:</td>
            <td>{{ $group->status == true ? 'Ativo' : 'Inativo' }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    
    
@endsection