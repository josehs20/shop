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
    {{-- onload para carregar as infomações e inputs de edição de produto --}}
    <body onload='preenche_campos(<?php echo $produto ?>), local_storage_dados_banco_ptc(<?php echo json_encode(["cores" => $cores, "tamanhos" => $tamanhos]) ?>)'>
        <div class="card mb-3">
        <form id="formUpdateProduto" method="POST" enctype="multipart/form-data">
            @csrf
            <h5 class="card-header d-flex justify-content-between col-12" data-bs-toggle="collapse" href="#cadastroDeProdutos"
                role="button" aria-expanded="false" aria-controls="cadastroDeProdutos">
                <a class="d-flex" onclick="rotacionarElemento('iconCadatroProduto')">
                    <i id="iconCadatroProduto" class="fa fa-caret-down"></i> &nbsp; Editar produto
                </a>
            </h5>
            @include('admin.produto.inc.inputs')
        </form>
    </div>

    {{-- lista da grade de tamanho cores e estoque --}}
    <div class="card">
            <div class="card-header search">
                <h5>Imagens</h5>
            </div>
        <div id="divListaImagensProdutos" class="card-body d-flex justify-content-around">
          
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="button" class="btn btn-outline-primary" onclick="adicionar_imagem(<?php echo $produto->first()->produto_id ?>)">Adicionar</button>
        </div>
    </div>
    <script src="{{ asset('js/admin/produto/updateProduto.js') }}" defer></script>

@endsection
