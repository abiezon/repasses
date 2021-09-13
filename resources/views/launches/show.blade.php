@extends('layouts.app')

@section('content')

  <div class="col-12 m-auto">
      <div class="col">
          <div class="float-left text-center col-10">
            <h2>Ver Lançamentos</h2>       
          </div>
          <div class="float-right">
            <a class="btn btn-danger" href="{{ route('home') }}"> Voltar</a>
            @can('isAdmin')
              <a class="btn btn-primary" href="{{ route('launches.edit', $launch) }}"> Editar</a>
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
            <td>Descrição:</td>
            <td>{{ $launch->description }}</td>
          </tr>
          <tr>
            <td>Tipo de Documento:</td>
            <td>{{ $launch->hasTypeDocument($launch->type_document_id) }}</td>
          </tr>
          <tr>
            <td>Data:</td>
            <td>{{ date('d/m/Y', strtotime($launch->date_document)) }}</td>
          </tr>
          <tr>
            <td>Arquivo:</td>
            <!-- <td><object data="{{ asset($url)}}"></object></td> -->
            <td><a href="{{ asset($url)}}" target="_blank"><i class="lni lni-download"></i> Baixar Arquivo</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    
    
@endsection