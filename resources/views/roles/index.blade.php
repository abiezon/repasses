@extends('layouts.app')

@section('content')

<h2 class="main-title">{{ __('Lista de Perfis')}}</h2>
   
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
              <th>Nome do Perfil</th>
              <th width="280px">Ações</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($roles as $role)
          <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $role->description }}</td>
              
              <td>
                  <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
      
                      <a class="btn btn-outline-secondary btn-block" href="{{ route('roles.show',$role->id) }}">
                        <i data-feather="eye" aria-hidden="true"></i>
                      </a>        
                      <a class="btn btn-outline-primary btn-block" href="{{ route('roles.edit',$role->id) }}">
                        <i data-feather="edit" aria-hidden="true"></i>
                      </a>
      
                      @csrf
                      @method('DELETE')
          
                      <button type="submit" class="btn btn-outline-danger btn-block">
                        <i data-feather="trash" aria-hidden="true"></i>
                      </button>
                  </form>
              </td>
          </tr>
        @endforeach
        </tbody>
    </table>
</div>
{!! $roles->links() !!}
@endsection