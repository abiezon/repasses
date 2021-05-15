@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            <h2 >Cadastro de Tipo de Documentos</h2>         
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
              <a class="btn btn-success" href="{{ route('type-documents.create') }}"> Novo</a>
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
                <th>Description</th>
                <th>Status</th>
                <th width="280px">Action</th>
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
        
                        <a class="btn btn-info" href="{{ route('type-documents.show',$type_document->id) }}">Show</a>        
                        <a class="btn btn-primary" href="{{ route('type-documents.edit',$type_document->id) }}">Edit</a>
        
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
    {!! $type_documents->links() !!}
    
@endsection