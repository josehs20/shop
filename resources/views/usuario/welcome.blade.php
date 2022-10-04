<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        padding: 0 40px
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
        width: 260px !important;
    }

    .collapse-mobile {
        display: none
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
    }
</style>

<body>
    @include('usuario.navbar.navbar')
    <section class="secao">
        <button class="btn btn-outline-success btn-filtro" data-bs-toggle="collapse" href="#collapseExampleMobile"
            role="button" aria-expanded="false" aria-controls="collapseExampleMobile">
            <i class="fa fa-filter"></i>Filtros
        </button>
        <div class="collapse collapse-mobile" id="collapseExampleMobile">
            <div class="card card-body">
                @include('usuario.filtro.filtro')
            </div>
        </div>
        <div class="div-filtro">
            @include('usuario.filtro.filtro')
        </div>
        <main class="conteudo">
            <h1>CONTEUDO</h1>
        </main>
    </section>
</body>

</html>
