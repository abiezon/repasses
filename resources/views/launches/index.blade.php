@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="row">
          <div class="col-10">
            <h2 >Lançamentos</h2>         
          </div>
          <div class="col-2">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
              <a class="btn btn-success" href="{{ route('launches.create') }}"> Novo</a>
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
          
                          <a class="btn btn-info" href="{{ route('launches.show',$launch->id) }}">Mostrar</a>        
                          <a class="btn btn-primary" href="{{ route('launches.edit',$launch->id) }}">Editar</a>
          
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
    {!! $launchs->links() !!}
    
@endsection