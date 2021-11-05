@extends('layouts.app')

@section('content')

<h2 class="main-title">{{ __('Lista de Lançamentos')}}</h2>
   
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
                  <th>Descrição</th>
                  <th>Tipo de Documento</th>
                  <th>Data</th>
                  <th width="280px">Ações</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($launchs as $launch)
              <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $launch->description }}</td>
                  <td>{{ $launch->hasTypeDocument($launch->type_document_id) }}</td>
                  <td>{{ date('d/m/Y', strtotime($launch->date_document)) }}</td>
                  <td>
                      <form action="{{ route('launches.destroy',$launch->id) }}" method="POST">

                          <a class="btn btn-outline-secondary btn-block" href="{{ route('launches.show',$launch->id) }}">
                            <i data-feather="eye" aria-hidden="true"></i>
                          </a>        
                          <a class="btn btn-outline-primary btn-block" href="{{ route('launches.edit',$launch->id) }}">
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
    {!! $launchs->links() !!}
    
@endsection