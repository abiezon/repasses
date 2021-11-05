@extends('layouts.app')

@section('content')

<h2 class="main-title">{{ __('Lista de Grupos')}}</h2>
   
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
      
                      <a class="btn btn-outline-secondary btn-block" href="{{ route('groups.show',$group->id) }}">
                        <i data-feather="eye" aria-hidden="true"></i>
                      </a>        
                      <a class="btn btn-outline-primary btn-block" href="{{ route('groups.edit',$group->id) }}">
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
{!! $groups->links() !!}
@endsection