@extends('layouts.app')

@section('content')

<h2 class="main-title">{{ __('Gerar Relatório de Lançamentos')}}</h2>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <div class="stat-cards-item users-table table-wrapper">
        <div class="col">
            <div class="float-end">
                <form action="{{ route('launches.report') }}" method="GET" class=" form-inline">
                    Data Inicial: <input type="date" class="search-wrapper date datepicker" name="search_dt_init" placeholder="dd/mm/YYYY" /> ou 
                    Data Final: <input type="date" class="search-wrapper date" name="search_dt_end" placeholder="dd/mm/YYYY" /> ou 
                    Tipo Documento: <input type="text" class="search-wrapper" name="search_type" placeholder="Digite o tipo de documento" />
                    <button type="submit" class="btn  btn-outline-primary btn-block"><i data-feather="search" aria-hidden="true"></i> Gerar</button>
                </form>
            </div>
        </div>
        
    </div>
    
@endsection