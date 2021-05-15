@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="float-left text-center col-12">
            <h2><i class="lni lni-dashboard"></i> Meu Dashboard</h2>         
        </div>
    </div>

    <div class="row">
        @can('isAdmin')
            <div class="col-4 mt-2">
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('users.index') }}" width="10">
                    <i class='lni lni-users'></i>
                {{ __('Usuários') }}
                </a>
            </div>

            <div class="col-4 mt-2">
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('roles.index') }}">
                <i class='lni lni-consulting'></i>
                {{ __('Perfis') }}
                </a>
            </div>

            <div class="col-4 mt-2">
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('groups.index') }}">
                    <i class='lni lni-book'></i>
                {{ __('Grupos') }}
                </a>
            </div>

            <div class="col-4 mt-2">
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('launches.index') }}">
                    <i class='lni lni-write'></i>
                {{ __('Lançamentos') }}
                </a>
            </div>

            <div class="col-4 mt-2">
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('type-documents.index') }}">
                    <i class='lni lni-notepad'></i>
                {{ __('Tipo Documentos') }}
                </a>
            </div>

            <div class="col-4 mt-2">
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('users.show', Auth::user()->id) }}">
                    <i class='lni lni-user'></i>
                {{ __('Meu Perfil') }}
                </a>
            </div>
        @endcan
        
        @can('isUser')                        

            <div class="col-4">
                <a class="btn btn-outline-danger btn-lg btn-block" href="{{ route('launches.index') }}">
                    <i class='lni lni-agenda'></i>
                {{ __('Lançamento de Repasses') }}
                </a>
            </div>

            <div class="col-4">
                <a class="btn btn-outline-danger btn-lg btn-block" href="{{ route('users.show', Auth::user()->id) }}">
                    <i class='lni lni-user'></i>
                {{ __('Meu Perfil') }}
                </a>
            </div>
        @endcan
    </div>
                
@endsection
