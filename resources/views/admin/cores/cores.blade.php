@extends('layouts.app', ['show' => 'cadastros', 'active' => 'cor'])

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
    <!-- DIV PAI PARA DIV FILHA DE CADASTRAR(C) E LISTAR(L) CATEGORIAS -->
    <div class="divPaiCL">
        <!-- CADASTRO DE CATEGORIAS -->
        <div class="card mb-3 cadastrarCores">
            <form id="formCadastrarCores" method="POST" onsubmit="post_cores(); return false;">
                @csrf
                <h5 class="card-header d-flex justify-content-between">
                    Cadastro de cores
                </h5>
                <div class="card-body">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1"><input type="color" name="codigo"></span>
                        <input required type="text" class="form-control" placeholder="Nome da cor" name="nome">
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
        <div class="card listarCores">
            <form onsubmit="get_cores(); return false;" id="formListaDeCores" method="GET">
                @csrf
                <div class="card-header search">
                    <h5>Lista de cores</h5>
                    <div class="input-group mb-3">
                        <!-- INPUT PARA PESQUISAR CATEGORIAS -->
                        <input id="inputPesquisarCor" type="search" class="form-control"
                            placeholder="Pesquise as cores" aria-label="Pesquise as cores">
                        <button class="input-group-text insearch" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <div id="divListaCores" class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Cor</th>
                                <th scope="col">Nome</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="tabelaCor">

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                </div>

            </form>
        </div>
    </div>
@endsection
<script src="{{ asset('js/admin/cor/cadastroCores.js') }}" defer></script>