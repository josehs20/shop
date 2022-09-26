@extends('layouts.app', ['show' => 'estoques', 'active' => 'balanco'])

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

    .listarCores {
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

        .listarCores {
            width: 100% !important
        }
    }
</style>

@section('content')

    <body onload='monta_lista_estoque(computa_produtos(<?php echo $produtos; ?>)), set_tam_cor_cat_storage(<?php echo json_encode($paramsFiltro); ?>)'>
        <!-- DIV PAI PARA DIV FILHA DE CADASTRAR(E) E LISTAR(L) CATEGORIAS -->
        <div class="divPaiCL">
            <!-- ESTOQUE -->
            <div class="card mb-3 cadastrarCores">
                <h5 class="card-header d-flex justify-content-between">
                    Buscar por:
                </h5>
                <div class="card-body">
                    <div id="cadastros">
                        <a onclick="modal_get_itens_filtro('categoria_id')"><p class="opcoes">- &emsp;Categoria</p></a>
                        <a onclick="modal_get_itens_filtro('tamanho_id')"><p class="opcoes">- &emsp;Tamanho</p></a>
                        <a onclick="modal_get_itens_filtro('cor_id')"><p class="opcoes">- &emsp;Cor</p></a>
                        <a onclick="modal_get_itens_filtro('preco')"><p class="opcoes">- &emsp;Preço</p></a>
                        <a onclick="modal_get_itens_filtro('quantidade')"><p class="opcoes">- &emsp;Quantidade no estoque</p></a>
                    </div>
                </div>
            </div>

            <!-- LISTA DE CATEGORIAS -->
            <div class="card listarCores">
                <form onsubmit="get_estoque(); return false;" id="formListaEstoque" method="GET">
                    @csrf
                    <div class="card-header search">
                        <h5>Estoques</h5>
                        <div class="input-group mb-3">
                            <!-- INPUT PARA PESQUISAR CATEGORIAS -->
                            <input id="inputPesquisarEstoque" type="search" class="form-control"
                                placeholder="Consultar estoque" aria-label="Consultar estoque">
                            <button class="input-group-text insearch" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>

                    <div id="divTabelaEstoque" class="card-body">
                    </div>
                    <div class="card-footer">
                    </div>

                </form>
            </div>
        </div>
        <script src="{{ asset('js/admin/estoque/principalEstoque.js') }}" defer></script>
    @endsection
