@extends('layouts.app')

@section('content')

<h2 class="main-title">Ver Lançamentos</h2>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <div class="stat-cards-item users-table">
      <table class="table  posts-table">
        <tbody>
          <tr>
            <td>Título:</td>
            <td>{{ $launch->description }}</td>
          </tr>
          <tr>
            <td>Usuário:</td>
            <td><span><?= $launch->hasUser($launch->id) ?></span></td>
          </tr>
          <tr>
            <td>Grupo:</td>
            <td><span><?= $launch->hasGroup($launch->id) ?></span></td>
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
            <td><a href="{{ asset($url)}}" target="_blank" class="btn btn-outline-primary btn-block"><i data-feather="download" aria-hidden="true"></i> Download</a></td>
          </tr>
          <tr>
            <td>Salvo em:</td>
            <td><?= Storage::disk('local')->path($launch->doc_file) ?></td>
          </tr>
        </tbody>
      </table>
      <a href="{{ URL::previous() }}" class="btn btn-outline-danger btn-block"><i data-feather="arrow-left" aria-hidden="true"></i> Voltar</a>
    </div>
    
@endsection