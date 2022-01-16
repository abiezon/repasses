@extends('layouts.app')

@section('content')

<h2 class="main-title">Relatório de Lançamentos</h2>

    <div class="stat-cards-item users-table table-wrapper">
        <table class="table">
            <thead>
              <tr>
                  <th>#</th>
                  <th>Título</th>
                  <th>Tipo de Documento</th>
                  <th>Data Envio</th>
                  <th>Usuário(s)</th>
                  <th>Grupo(s)</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($launchs as $launch)
              <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $launch->description }}</td>
                  <td>{{ $launch->hasTypeDocument($launch->type_document_id) }}</td>
                  <td>{{ date('d/m/Y', strtotime($launch->date_document)) }}</td>
                  <td><span><?= $launch->hasUser($launch->id) ?></span></td>
                  <td><span><?= $launch->hasGroup($launch->id) ?></span></td>
              </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $launchs->links() !!}
    
    
@endsection