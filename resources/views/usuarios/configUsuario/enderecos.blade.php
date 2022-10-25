@extends('layouts.baseUsuario')

<style>
    .div-filtro {
        display: none !important;
    }

    .btn-filtro {
        display: none !important;
    }

    .conteudo-principal {
        margin-left: 0;
    }

    @media(max-width: 860px) {
        
    }
</style>

@section('conteudo')
    <h1>ENDERECOS</h1>
    <script src="{{ asset('js/usuario/configuracoesUsuario/meusDados.js') }}" defer></script>
@endsection
