@extends('layouts.app')

@section('content')

<h2 class="main-title">{{ __('Lista de Tipos de Documentos')}}</h2>
   
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
                  <th>Status</th>
                  <th width="280px">Ações</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($type_documents as $type_document)
              <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $type_document->description }}</td>
                  <td>{{ $type_document->status == true ? 'Ativo' : 'Inativo' }}</td>
                  
                  <td>
                      <form action="{{ route('type-documents.destroy',$type_document->id) }}" method="POST">
       
                          <a class="btn btn-outline-primary btn-block" href="{{ route('type-documents.edit',$type_document->id) }}">
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
    {!! $type_documents->links() !!}
    
@endsection