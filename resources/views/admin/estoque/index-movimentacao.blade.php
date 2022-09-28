@extends('layouts.app', ['show' => 'estoques', 'active' => 'movimentacao'])

<style>
    .card-body {
        display: flex;
        flex-wrap: wrap;
    }

    .cadastrarCores {
        width: 300px !important;
        height: fit-content !important;
    }

    .divPaiCL {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }

    .listarEstoque {
        width: 70%
    }

    .opcoes{
        cursor: pointer;
    }

    .search {
        display: flex;
        justify-content: space-between;
        align-items: center
    }

    .search>div {
        width: 70% !important;
        height: fit-content;
        margin: 0 !important;
    }

    .search>h5 {
        margin: 0 !important;
        height: fit-content;
    }

    .insearch i {
        color: #000 !important
    }

    .insearch:hover i {
        color: #FFF !important
    }

    .insearch:hover {
        background-color: orangered;
    }

    @media(max-width: 860px) {
        .divPaiCL {
            display: unset !important
        }

        .cadastrarCores {
            width: 100% !important
        }

        .listarEstoque {
            width: 100% !important
        }
    }
</style>

@section('content')

    <body onload='monta_lista_estoque(computa_produtos(<?php echo $produtos; ?>), "movimentacao"), set_tam_cor_cat_storage(<?php echo json_encode($paramsFiltro); ?>)'>
 
        @include('admin.estoque.inc.view-base')

        <script src="{{ asset('js/admin/estoque/principalEstoque.js') }}" defer></script>
    @endsection