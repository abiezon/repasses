@extends('layouts.app')

@section('content')

<h2 class="main-title">Dados do Perfil</h2>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <div class="stat-cards-item users-table">
      <table class="table  posts-table">
        <tbody>
          <tr>
            <td>Nome:</td>
            <td>{{ $role->description }}</td>
          </tr>          
        </tbody>
      </table>
    </div>
    
    
@endsection