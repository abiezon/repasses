@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">            
              <h2>Dados do Perfil</h2>                    
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>            
            <a class="btn btn-primary" href="{{ route('roles.edit', $role) }}"> Editar</a>            
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
            <td>{{ $role->description }}</td>
          </tr>          
        </tbody>
      </table>
    </div>
    
    
@endsection