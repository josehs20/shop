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
                        Dados do cliente:
                    </h5>
                    <div class="card-body">
                        <div id="filtrosEstoque">
                            dados

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
                               
                            </div>
                        </div>
        
                        <div id="divTabelaPedido" class="card-body">
                            
                        </div>
                        <div class="card-footer">
                        </div>
        
                    </form>
                </div>
            </div>

        <script src="{{ asset('js/admin/pedidos/show.js') }}" defer></script>
    @endsection
