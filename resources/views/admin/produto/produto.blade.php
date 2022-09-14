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
    <div class="card mb-3">
        <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">
                <a data-bs-toggle="collapse" href="#cadastroDeProdutos" role="button" aria-expanded="false"
                    aria-controls="cadastroDeProdutos">
                    <i class="fa fa-caret-down"></i> Cadastro de produtos
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
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('produto.store') }}" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header">
                Lista de produtos
            </h5>

            <div class="card-body">
                <h1>PRODUTOS FICAM AQUI</h1>
            </div>
            <div class="card-footer">
                <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
                <div>
                    <!-- BOTOES FICAM AQUI -->
                    <button type="submit" class="btn"></button>
                </div>
            </div>

        </form>
    </div>
@endsection
