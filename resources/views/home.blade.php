@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h2 class="main-title">Dashboard</h2>

    <div class="row stat-cards">
        @can('isAdmin')
            <div class="col-md-6 col-xl-4">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon primary">
                        <i data-feather="users" aria-hidden="true"></i>
                    </div>
                    <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ __('Usuários') }}</p>
                        <p class="stat-cards-info__title">{{ __('Usuários Ativos') }}</p>
                        <p class="stat-cards-info__progress">
                            <span class="stat-cards-info__profit success">
                            <i data-feather="bar-chart" aria-hidden="true"></i>{{ $users }}
                            </span>
                            <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('users.index') }}">
                                {{ __('Ver mais') }}
                            </a>
                        </p>
                    </div>
                </article>
            </div>
            <div class="col-md-6 col-xl-4">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon warning">
                        <i data-feather="settings" aria-hidden="true"></i>
                    </div>
                    <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ __('Perfis') }}</p>
                        <p class="stat-cards-info__title">{{ __('Perfis Ativos') }}</p>
                        <p class="stat-cards-info__progress">
                            <span class="stat-cards-info__profit success">
                                <i data-feather="bar-chart" aria-hidden="true"></i>{{ $roles }}
                            </span>
                            <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('roles.index') }}">
                                {{ __('Ver mais') }}
                            </a>
                        </p>
                    </div>
                </article>
            </div>

            <div class="col-md-6 col-xl-4">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon purple">
                        <i data-feather="globe" aria-hidden="true"></i>
                    </div>
                    <div class="stat-cards-info">
                        <p class="stat-cards-info__num">{{ __('Grupos') }}</p>
                        <p class="stat-cards-info__title">{{ __('Grupos Ativos') }}</p>
                        <p class="stat-cards-info__progress">
                            <span class="stat-cards-info__profit success">
                                <i data-feather="bar-chart" aria-hidden="true"></i>{{ $groups }}
                            </span>
                            <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('groups.index') }}">
                                {{ __('Ver Mais') }}
                            </a>
                        </p>
                    </div>
                </article>
            </div>

            <div class="col-md-6 col-xl-4">
                <article class="stat-cards-item">
                    <div class="stat-cards-icon primary">
                    <i data-feather="file-text" aria-hidden="true"></i>
                    </div>
                    <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ __('Tipo Documentos') }}</p>
                    <p class="stat-cards-info__title">{{ __('Tipos de Documentos Disponíveis') }}</p>
                    <p class="stat-cards-info__progress">
                        <span class="stat-cards-info__profit success">
                        <i data-feather="bar-chart" aria-hidden="true"></i>{{ $type_documents }}
                        </span>
                        <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('type-documents.index') }}">
                            <i class='lni lni-notepad'></i>
                            {{ __('Ver Mais') }}
                        </a>
                    </p>
                    </div>
                </article>
            </div>
        @endcan
        
        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
                <div class="stat-cards-icon success">
                    <i data-feather="activity" aria-hidden="true"></i>
                </div>
                <div class="stat-cards-info">
                    <p class="stat-cards-info__num">{{ __('Lançamentos') }}</p>
                    <p class="stat-cards-info__title">{{ __('Lançamentos no Portal') }}</p>
                    <p class="stat-cards-info__progress">
                        <span class="stat-cards-info__profit success">
                            <i data-feather="bar-chart" aria-hidden="true"></i>{{ $launches }}
                        </span>
                        <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('launches.index') }}">
                            <i class='lni lni-write'></i>{{ __('Ver Mais') }}
                        </a>
                    </p>
                </div>
            </article>
        </div>

        <div class="col-md-6 col-xl-4">
            <article class="stat-cards-item">
              <div class="stat-cards-icon success">
                <i data-feather="user" aria-hidden="true"></i>
              </div>
              <div class="stat-cards-info">
                <p class="stat-cards-info__num">{{ __('Meu Perfil') }}</p>
                <p class="stat-cards-info__title">Dados do meu perfil</p>
                <p class="stat-cards-info__progress">
                    <span class="stat-cards-info__profit success">
                        <i data-feather="compass" aria-hidden="true"></i>
                    </span>
                    <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('users.show', Auth::user()->id) }}">
                        {{ __('Ver Mais') }}
                    </a>
                </p>
              </div>
            </article>
        </div>
    </div>
                
@endsection
