@extends('layouts.app')

@section('content')

<h2 class="main-title">Ver Grupos</h2>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
  
    <div class="stat-cards-item users-table">
      <table class="table  posts-table table-stripedable">
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