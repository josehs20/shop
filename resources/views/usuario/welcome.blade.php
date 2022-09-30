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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</head>

<body>
    @include('usuario.navbar.navbar')
    <main>
        
    </main>
</body>

</html>
