<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- ICONES FAS FA-->
    <script src="https://kit.fontawesome.com/fc066fbf39.js" crossorigin="anonymous" defer></script>

    <!-- CSS para todas as páginas -->
    <link rel="stylesheet" href="{{ asset('css/geralUsuario.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<style>
    .secao {
        display: flex;
        padding: 0 30px
    }

    .conteudo {
        width: 100%;
        padding-left: 20px !important;
    }

    .btn-filtro {
        display: none;
        margin-bottom: 20px;
    }

    .div-filtro {
        display: block;
        width: 200px !important;
    }

    .collapse-mobile {
        display: none
    }

    .viewcarrinho {
        display: flex;
        position: fixed;
        top: 0;
        right: 0;
        z-index: 998;
        width: 0 !important;
        height: 100%;
        overflow: hidden !important;
        overflow-y: scroll;
        transition: 0.5s;
    }

    .viewcarrinho .fundo {
        background-color: #414141;
        opacity: .7;
        height: 100%;
        width: 60%;
    }

    .mostraViewCarrinho {
        width: 100% !important;
    }





  
  
  
  
    /* ---------------------------------- */

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





  /* ---------------------------------- */ 




    @media(max-width: 860px) {
        .secao {
            flex-direction: column
        }

        .div-filtro {
            display: none
        }

        .btn-filtro {
            display: block;
        }

        .conteudo {
            margin-top: 20px;
            padding-left:  0 !important
        }

        .collapse-mobile {
            display: block
        }

        .viewcarrinho .fundo {
            width: 10%;
        }
    }
</style>

<body>
    @include('usuarios.navbar.navbar')

    @if (Session::get('success'))

        <body onload="alerta('success', '<?php echo Session::get('success'); ?>', '', '') ">
    @endif

    @if (Session::get('setPedidosItens'))

        <body onload="create_pedido()">
    @endif

    @if (auth()->user())

        <body onload="get_pedidos_ptc(true)">
        @else

            <body onload="get_pedidos_ptc()">
    @endif

    <section class="secao">
        {{-- FILTRO NO MOBILE É NO COLAPSE --}}
        <button class="btn btn-outline-success btn-filtro" data-bs-toggle="collapse" href="#collapseExampleMobile"
            role="button" aria-expanded="false" aria-controls="collapseExampleMobile">
            <i class="fa fa-filter"></i>Filtros
        </button>
        <div class="collapse collapse-mobile" id="collapseExampleMobile">
            <div class="card card-body">
                @include('usuarios.filtro.filtro')
            </div>
        </div>
        {{-- FILTRO NO WEB --}}
        <div class="div-filtro">
            @include('usuarios.filtro.filtro')
        </div>
        {{-- CONTEUDO --}}
        <main class="conteudo">
            <div>
                @if (auth()->user())
                    <div class="conteudo-completo">
                        @if (Request::segment(1) == 'configUsuario')
                            <!-- CONTEUDO EM CONFIG -->
                            <div class="conteudo-principal" style="margin:0 !important">
                                <div class="main-config">
                                    @include('usuarios.configUsuario.menuConfig') <!--MENU DAS CONFIGURAÇÕES DE MINHA CONTA-->
                                    @yield('conteudo')
                                </div>
                            </div>
                        @else
                            <!-- CONTEUDO -->
                            <div class="conteudo-principal">
                                @yield('conteudo')
                            </div>
                        @endif
                    </div>
                @else
                    @yield('conteudo')
                @endif
            </div>
            {{-- @if (count($produtoIndividual))
                <style>
                    .div-filtro {
                        display: none;
                    }

                    .btn-filtro {
                        display: none;
                    }
                </style>
                @include('usuarios.produtos.unicoProduto')
            @else
                @include('usuarios.produtos.variosProdutos', ['produtos' => $produtos])
            @endif --}}

            {{-- PAGINA DO CARRINHO  --}}
            <div id="viewcarrinho" class="viewcarrinho">
                <div class="fundo"></div>
                @include('usuarios.carrinho.carrinho')
            </div>
        </main>
    </section>
</body>

<script>
    function abrirFecharCarrinho() {
        var viewCarrinho = document.getElementById('viewcarrinho')
        viewCarrinho.classList.toggle('mostraViewCarrinho')
    }
</script>
<script src="{{ asset('js/principalFrontEnd.js') }}"></script>
<script src="{{ asset('js/usuario/unicoProduto.js') }}"></script>
<script src="{{ asset('js/principalBackEnd.js') }}"></script>
<script src="{{ asset('js/alertas.js') }}" defer></script>

</html>
