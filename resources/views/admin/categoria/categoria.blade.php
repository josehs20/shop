@extends('layouts.app')

<style>
    .card-body {
        display: flex;
        flex-wrap: wrap;
    }
    .cadastrarCategoria {
        width: 300px !important;
        height: fit-content !important;
    }

    .divPaiCL {
        display: flex;
        flex-direction: row-reverse;
        justify-content: space-between;
    }

    .listarCategoria {
        width: 70%
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
        .divPaiCL {
            display: unset !important
        }

        .cadastrarCategoria {
            width: 100% !important
        }

        .listarCategoria {
            width: 100% !important
        }
    }
</style>

@section('content')
    <!-- DIV PAI PARA DIV FILHA DE CADASTRAR(C) E LISTAR(L) CATEGORIAS -->
    <div class="divPaiCL">
        <!-- CADASTRO DE CATEGORIAS -->
        <div class="card mb-3 cadastrarCategoria">
            <form id="formCadastrarCategoria" method="POST" onsubmit="post_categorias(); return false;">
                @csrf
                <h5 class="card-header d-flex justify-content-between">
                    Cadastro de categorias
                </h5>
                <div class="card-body">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-flag"></i></span>
                        <input required type="text" class="form-control" placeholder="Nome da categoria" name="nome">
                    </div>
                </div>
                <div class="card-footer">
                    <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
                    <div>
                        <!-- BOTOES FICAM AQUI -->
                        <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
                        <button type="reset" class="btn btn-outline-secondary">Limpar campos</button>
                    </div>
                </div>

            </form>
        </div>

        <!-- LISTA DE CATEGORIAS -->
        <div class="card listarCategoria">
            <form onsubmit="get_categorias(); return false;" id="formListaDeCategorias" method="GET">
                @csrf
                <div class="card-header search">
                    <h5>Lista de categorias</h5>
                    <div class="input-group mb-3">
                        <!-- INPUT PARA PESQUISAR CATEGORIAS -->
                        <input id="inputPesquisarCategoria" type="search" class="form-control"
                            placeholder="Pesquise as categorias" aria-label="Pesquise as categorias">
                        <button class="input-group-text insearch" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <div id="divListaCategorias" class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Categoria</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaCategoria">
                            
                        </tbody>    
                    </table>
                </div>
                <div class="card-footer">
                </div>

            </form>
        </div>
    </div>
@endsection
<script src="{{ asset('js/admin/cadastroCategoria.js') }}" defer></script>