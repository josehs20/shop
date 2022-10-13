<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


    <title>Laravel</title>

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
        padding-left: 20px;
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
            @if (count($produtoIndividual))
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
            @endif

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

</html>
