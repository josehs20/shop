<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- CSS para todas as páginas -->
    <link rel="stylesheet" href="{{ asset('css/geral.css') }}">

    <!-- ICONES FAS FA-->
    <script src="https://kit.fontawesome.com/fc066fbf39.js" crossorigin="anonymous" defer></script>

</head>

<style>
    .main-config {
        display: flex;
    }

    .conteudo-completo {
        display: flex;
    }

    .conteudo-sidebar {
        position: fixed;
        width: 260px;
        height: 100vh;
        overflow: auto;
        transition: 1s;
        top: 0;
        left: 0;
        z-index: 15000;
    }

    .conteudo-principal {
        margin-left: 260px;
        width: 100%;
        height: 100%;
        padding: 20px;
    }

    .mostrarSidebar {
        width: 260px !important;
    }

    .active {
        background-color: orangered !important
    }

    .list-group {
        width: 260px;
        box-shadow: 0px 0px 5px #ccc !important;
    }

    .list-group-item {
        border-color: #CCC !important
    }

    @media(max-width: 860px) {
        .main-config {
            flex-direction: column;
            justify-content: center;
            align-items: center
        }

        .conteudo-sidebar {
            width: 0;
        }

        .conteudo-principal {
            margin-left: unset !important
        }
    }
</style>

<body>
    <div id="app">
        @if (Session::get('msgAlerta'))

            <body onload="alerta('<?php echo Session::get('msgAlerta')[0]; ?>', 
                                '<?php echo Session::get('msgAlerta')[1]; ?>')">
        @endif
        <div>
            @if (auth()->user())
                <div class="conteudo-completo">
                    @if (Request::segment(1) == 'config')
                        <!-- CONTEUDO EM CONFIG -->
                        <div class="conteudo-principal" style="margin:0 !important">
                            @include('admin.navbar.navbar')
                            <div class="main-config">
                                @include('admin.config.menuConfig') <!--MENU DAS CONFIGURAÇÕES DE MINHA CONTA-->
                                @yield('content')
                            </div>
                        </div>
                    @else
                        <!-- SIDEBAR -->
                        <div id="conteudoSidebar" class="conteudo-sidebar">
                            @include('admin.sidebar.sidebar')
                        </div>
                        <!-- CONTEUDO -->
                        <div class="conteudo-principal">
                            @include('admin.navbar.navbar')
                            @yield('content')
                        </div>
                    @endif
                </div>
            @else
                @yield('content')
            @endif
        </div>
    </div>


    {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
    <script src="{{ asset('js/principalFrontEnd.js') }}" defer></script>
    <script src="{{ asset('js/principalBackEnd.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>
</body>

</html>
