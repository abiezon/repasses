<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/svg/logo.svg" type="image/x-icon">

    <title>Repasses</title>
    <!-- Styles -->
    <!-- CSS only -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- CSS only -->
</head>
<body>
    <div class="layer"></div>
    @auth
        <div class="page-flex">
            <aside class="sidebar">
                <div class="sidebar-start">
                    <div class="sidebar-head">
                        <a href="/" class="logo-wrapper" title="Home">
                            <span class="sr-only">Home</span>
                            <!-- <span class="icon logo" aria-hidden="true"></span> -->
                            <div class="logo-text">
                                <span class="logo-title">Repasses</span>
                                <span class="logo-subtitle">Dashboard</span>
                            </div>

                        </a>
                        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                            <span class="sr-only">Toggle menu</span>
                            <span class="icon menu-toggle" aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="sidebar-body">
                        <ul class="sidebar-body-menu">
                            <li>
                                <a class="active" href="/"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                            </li>
                            <li>
                                <a class="show-cat-btn" href="##">
                                    <span class="icon folder" aria-hidden="true"></span>Grupos
                                    <span class="category__btn transparent-btn" title="Open list">
                                        <span class="sr-only">Open list</span>
                                        <span class="icon arrow-down" aria-hidden="true"></span>
                                    </span>
                                </a>
                                <ul class="cat-sub-menu">
                                    <li>
                                        <a href="{{ route('groups.index') }}">Listar Todos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('groups.create') }}">Adicionar Novo</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="show-cat-btn" href="##">
                                    <span class="icon paper" aria-hidden="true"></span>Tipo Documentos
                                    <span class="category__btn transparent-btn" title="Open list">
                                        <span class="sr-only">Open list</span>
                                        <span class="icon arrow-down" aria-hidden="true"></span>
                                    </span>
                                </a>
                                <ul class="cat-sub-menu">
                                    <li>
                                        <a href="{{ route('type-documents.index') }}">Listar Todos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('type-documents.create') }}">Adicionar Novo</a>
                                    </li>
                                </ul>
                            </li>
                        
                            <li>
                                <a class="show-cat-btn" href="##">
                                    <span class="icon edit" aria-hidden="true"></span>Lançamentos
                                    <span class="category__btn transparent-btn" title="Open list">
                                        <span class="sr-only">Open list</span>
                                        <span class="icon arrow-down" aria-hidden="true"></span>
                                    </span>
                                </a>
                                <ul class="cat-sub-menu">
                                    <li>
                                        <a href="{{ route('launches.index') }}">Listar Todos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('launches.create') }}">Adicionar Novo</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="show-cat-btn" href="##">
                                    <span class="icon category" aria-hidden="true"></span>Perfis
                                    <span class="category__btn transparent-btn" title="Open list">
                                        <span class="sr-only">Open list</span>
                                        <span class="icon arrow-down" aria-hidden="true"></span>
                                    </span>
                                </a>
                                <ul class="cat-sub-menu">
                                    <li>
                                        <a href="{{ route('roles.index') }}">Listar Todos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.create') }}">Adicionar Novo</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="show-cat-btn" href="##">
                                    <span class="icon user-3" aria-hidden="true"></span>Usuários
                                    <span class="category__btn transparent-btn" title="Open list">
                                        <span class="sr-only">Open list</span>
                                        <span class="icon arrow-down" aria-hidden="true"></span>
                                    </span>
                                </a>
                                <ul class="cat-sub-menu">
                                    <li>
                                        <a href="{{ route('users.index') }}">Listar Todos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.create') }}">Adicionar Novo</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="##"><span class="icon setting" aria-hidden="true"></span>{{ __('Configurações') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="main-wrapper">
                <!-- ! Main nav -->
                <nav class="main-nav--bg">
                    <div class="container main-nav">
                        <div class="main-nav-start"></div>
                        <div class="main-nav-end">
                            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                                <span class="sr-only">Toggle menu</span>
                                <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                            </button>
                            <div class="lang-switcher-wrapper"></div>
                            <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                                <span class="sr-only">Switch theme</span>
                                <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                                <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                            </button>
                            <div class="notification-wrapper"></div>
                            <div class="nav-user-wrapper">
                            <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                                <span class="sr-only">My profile</span>
                                <span class="nav-user-img">
                                    <picture><source srcset="/img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
                                </span>
                            </button>
                            <ul class="users-item-dropdown nav-user-dropdown dropdown">
                                <li><a href="/users/{{Auth::user()->id}}">
                                    <i data-feather="user" aria-hidden="true"></i>
                                    <span>{{ __('Perfil') }}</span>
                                    </a>
                                </li>
                                <li><a href="##">
                                    <i data-feather="settings" aria-hidden="true"></i>
                                    <span>{{ __('Configurações') }}</span>
                                    </a>
                                </li>
                                <li><a class="danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out" aria-hidden="true"></i>
                                    <span>{{ __('Sair') }}</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- ! Main -->
                <main class="main users chart-page" id="skip-target">
                    <div class="container">
                        @yield('content')
                    </div>
                </main>
                <!-- ! Footer -->
                <footer class="footer">
                    <div class="container footer--flex">
                        <div class="footer-start">
                            <p>2021 © Repasses</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    @else
        @yield('content')
    @endauth

    <!-- JavaScript Bundle with Popper -->
    <script src="/plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="/plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
