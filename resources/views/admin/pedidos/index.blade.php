@extends('layouts.app', ['show' => 'pedidos', 'active' => 'pedidos'])

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

              <!-- DIV PAI PARA DIV FILHA DE CADASTRAR(E) E LISTAR(L) CATEGORIAS -->
              <div class="divPaiCL">
                <!-- ESTOQUE -->
                <div class="card mb-3 cadastrarCores">
                    <h5 class="card-header d-flex justify-content-between">
                        Buscar por:
                    </h5>
                    <div class="card-body">
                        <div id="filtrosEstoque">
                            <a onclick=""><p class="opcoes d-flex"><i class="fa fa-calendar-alt"></i>&emsp;Data de compra</p></a>
                            <a onclick=""><p class="opcoes d-flex"><i class="fa fa-map-marker-alt"></i></i>&emsp;Localidade</p></a>
                            <a onclick=""><p class="opcoes d-flex"><i class="fa fa-dollar-sign"></i>&emsp;Valor</p></a>
                            <a onclick=""><p class="opcoes d-flex"><i class="fa fa-stopwatch"></i>&emsp;Em espera</p></a>
                            <a onclick=""><p class="opcoes d-flex"><i class="fa fa-route"></i>&emsp;Enviados</p></a>

                        </div>
                    </div>
                </div>
        
                <!-- LISTA DE CATEGORIAS -->
                <div class="card listarEstoque" >
                    <form onsubmit="modal_get_itens_filtro('nome'); return false;" id="formListaEstoque" method="GET">
                        @csrf
                        <div class="card-header search">
                            <h5>Pedidos</h5>
                            <div class="input-group mb-3">
                                <!-- INPUT PARA PESQUISAR CATEGORIAS -->
                                <input id="inputPesquisarPedido" type="search" class="form-control"
                                    placeholder="Consultar pedidos pelo nome do cliente" aria-label="Consultar estoque">
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

        <script src="{{ asset('js/admin/pedidos/index.js') }}" defer></script>
    @endsection
