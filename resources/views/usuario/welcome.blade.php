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

    .filtro {
        width: 260px;
        min-height: 80vh;
    }

    .filtro ul {
        list-style: none;
        padding: 0;
        width: 100% !important
    }

    .filtro>ul>li>a {
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
        width: 100% !important;
    }

    .conteudo {
        width: 100%;
        padding-left: 20px
    }
</style>

<body>
    @include('usuario.navbar.navbar')
    <section class="secao">
        <aside class="filtro">
            <h3>Filtros</h3>
            <hr style="border-color: #000 !important; background: #000; height: 2px">
            <ul>
                <li>
                    
                        <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            Categorias <i class="fa fa-caret-down"></i>
                        </a>
                    

                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <ul>
                                @foreach ($categorias as $categoria)
                                    <li><a href="#">{{ $categoria->nome }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr>
                </li>
            </ul>
        </aside>
        <main class="conteudo">
            <h1>CONTEUDO</h1>
        </main>
    </section>
</body>

</html>
