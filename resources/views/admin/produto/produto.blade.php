@extends('layouts.app')
<style>
    .card-body {
        display: flex;
        flex-wrap: wrap;
    }

    .card-body input {
        margin-right: 7px
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
    }

    .inome {
        width: 55% !important
    }

    .inumero {
        width: 140px !important;
    }

    .icategoria {
        width: 140px !important;
        margin-right: 7px;
        margin-bottom: 10px;
        height: fit-content;
    }

    .icor {
        width: 120px !important;
        margin-right: 7px;
        margin-bottom: 10px;
        height: fit-content;
    }

    .itamanho {
        width: 140px !important;
        margin-right: 7px;
        margin-bottom: 10px;
        height: fit-content;
    }

    .iestoque {
        width: 150px !important;
        margin-right: 7px;
        height: fit-content;
    }

    .iimagem {
        width: 400px !important;
        height: fit-content;
        margin-right: 7px;
        margin-bottom: 10px;
    }

    .search{
        display: flex;
        justify-content: space-between;
        align-items: center
    }

    .search > div{
        width: 70% !important;
        height: fit-content;
        margin: 0 !important;
    }

    .search > h5 {
        margin: 0 !important;
        height: fit-content;
    }
    
    .insearch i{
        color: #000 !important
    }

    .insearch:hover i{
        color: #FFF !important
    }

    .insearch:hover{
        background-color: orangered;
    }

    @media(max-width: 860px) {
        .card-body {
            justify-content: space-between
        }

        .inome {
            width: 100% !important
        }

        .inumero {
            width: 100% !important;
        }

        .icategoria {
            width: 47% !important;
        }

        .icor {
            width: 47% !important;
        }

        .itamanho {
            width: 47% !important;
        }

        .iestoque {
            width: 100% !important
        }

        .iimagem {
            width: 100% !important;
        }
    }
</style>
@section('content')
    <!-- CADASTRO DE PRODUTOS -->
    <div class="card mb-3">
        <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header d-flex justify-content-between">
                <a class="d-flex" onclick="rotacionarElemento('iconCadatroProduto')" data-bs-toggle="collapse"
                    href="#cadastroDeProdutos" role="button" aria-expanded="false" aria-controls="cadastroDeProdutos">
                    <i id="iconCadatroProduto" class="fa fa-caret-down"></i> &nbsp; Cadastro de produtos
                </a>
            </h5>

            <div class="collapse" id="cadastroDeProdutos">
                <div class="card-body">
                    <div class="input-group mb-2 inome">
                        <span class="input-group-text" id="basic-addon1"><i class="fab fa-product-hunt"></i></span>
                        <input type="text" class="form-control" placeholder="Nome do produto" name="nome">
                    </div>
                    <div class="input-group mb-2 inumero">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
                        <input type="number" class="form-control" placeholder="Custo" name="custo">
                    </div>
                    <div class="input-group mb-2 inumero">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
                        <input type="number" class="form-control" placeholder="Preço" name="preco">
                    </div>
                    <div class="input-group mb-2 inumero">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
                        <input type="number" class="form-control" placeholder="Lucro" name="lucro">
                    </div>
                    <select class="form-select icategoria" aria-label="Default select example">
                        <option selected>Categoria</option>
                        <option value="1">Calça</option>
                        <option value="2">Camisa</option>
                    </select>
                    <select class="form-select icor" aria-label="Default select example">
                        <option selected>Cor</option>
                        <option value="1">Cinza</option>
                        <option value="2">Branco</option>
                        <option value="3">Vermelho</option>
                    </select>
                    <select class="form-select itamanho" aria-label="Default select example">
                        <option selected>Tamanho</option>
                        <option value="1">PP</option>
                        <option value="2">P</option>
                        <option value="3">M</option>
                        <option value="4">G</option>
                        <option value="5">GG</option>
                    </select>
                    <div class="input-group mb-2 iestoque">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-memory"></i></span>
                        <input type="number" class="form-control" placeholder="Estoque" name="estoque">
                    </div>

                    <input required type="file" class="form-control disabledInsert iimagem" id="imagensProdutoValue"
                        accept="image/*" multiple placeholder="Imagem">
                </div>
                <div class="card-footer">
                    <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
                    <div>
                        <!-- BOTOES FICAM AQUI -->
                        <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
                        <button type="reset" class="btn btn-outline-secondary">Limpar campos</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- LISTA DE PRODUTOS -->
    <div class="card">
        <form id="formListaDeProdutos" method="GET">
            @csrf
            <div class="card-header search">
                <h5>Lista de produtos</h5>
                <div class="input-group mb-3">
                    <!-- INPUT PARA PESQUISAR PRODUTOS -->
                    <input id="inputPesquisarProduto" type="search" class="form-control" placeholder="Pesquise os produtos"
                        aria-label="Pesquise os produtos">
                    <button class="input-group-text insearch" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>

            <div id="divListaProdutos" class="card-body">

            </div>
            <div class="card-footer">
            </div>

        </form>
    </div>
@endsection
<script src="{{ asset('js/admin/cadastroProduto.js') }}" defer></script>
