@extends('layouts.app', ['show' => 'confEnvio', 'active' => 'confEnvio'])

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

    /* .listarEstoque {
        width: 70%
    } */

    .opcoes {
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

    <div id="divPaiCL" class="divPaiCL">
        @if (!count($categorias))

            <body
                onload="div_nao_contem_registro('divPaiCL', 'Necessário ter ao menos uma categoria para esta configuração')">
            @else
                <!-- LISTA DE CATEGORIAS -->
                <div class="card listarCategoriasConfig">
                    {{-- <form onsubmit="modal_get_itens_filtro('nome'); return false;" id="formListaEstoque" method="GET">
                    @csrf --}}
                    <div class="card-header search">
                        <h5>Configurações de envio</h5>
                        <div class="input-group mb-3">
                            <!-- INPUT PARA PESQUISAR CATEGORIAS -->
                            {{-- <input id="inputPesquisarEstoque" type="search" class="form-control"
                                placeholder="Consultar estoque" aria-label="Consultar estoque">
                            <button class="input-group-text insearch" type="submit"><i class="fa fa-search"></i></button> --}}
                        </div>
                    </div>

                    <div id="divEditCategoria" class="card-body">
                        <span class="text mr-2">Endereco de origem: De onde suas mercadorias irão sair.</span>
                        <div title="De onde a mercadoria está saindo" class="input-group mt-2">
                        <span class="input-group-text">Endereco de onrigem</span>
                        <input placeholder="99999-999" type="text" onkeyup="buscaCep('inputCep', 'inputCidade', 'inputUf')"
                        id="inputCep" class="form-control col-md-6 mr-3" value="{{$enderecoOrigem && $enderecoOrigem->cep ? substr_replace($enderecoOrigem->cep, '-', 5, 0) : ''}}">
                        <input placeholder="cidade" type="text" readonly value="{{$enderecoOrigem && $enderecoOrigem->cidade ? $enderecoOrigem->cidade : ''}}"
                        id="inputCidade" class="form-control col-md-6 mr-3">
                        <input placeholder="UF" type="text" readonly value="{{$enderecoOrigem && $enderecoOrigem->estado ? $enderecoOrigem->estado : ''}}"
                        id="inputUf" class="form-control col-md-6 mr-3">
                        <button disabled id="botaoConfirmCep" type="button" onclick="post_cep()"
                        class="btn btn-outline-primary">Confirmar cep</button>
                        </div>
                       <div class="row w-100">
                        <h6 style="margin-left: 60% !important;" id="msgCep"></h6>
                       </div>
                       <br><br>
                       <span class="text mr-2">Configurações de embalagem: Necessária para cálculo de frete, Deve ser passado como uma unidade. As medidas são separadas por categorias.</span>

                        <div class="input-group mt-2 mb-5">
                            <span class="input-group-text">exemplo</span>
                            <a class="form-control">largura (cm) : 20,00 </a>
                            <a class="form-control">altura (cm): 10,00</a>
                            <a class="form-control">comprimento (cm) : 50,00</a>
                            <a class="form-control">peso (kg): 0,5</a>
                            <button type="button" onclick="exemplo_caixa()"
                                class="btn btn-outline-primary">Ilustração</button>
                        </div>
                        @foreach ($categorias as $c)
                            <div id="divInputs{{ $c->id }}" class="input-group mt-2">
                                <span class="input-group-text">{{ $c->nome }}</span>
                                <input name="largura" type="number"
                                    placeholder="Largura {{ $c->largura ? $c->largura : '' }}"
                                    onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                    value="{{ $c->largura ? $c->largura : '' }}">
                                <input name="altura" type="number" placeholder="Altura {{ $c->altura ? $c->altura : '' }}"
                                    onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                    value="{{ $c->altura ? $c->altura : '' }}">
                                <input name="comprimento" type="number"
                                    placeholder="Comprimento {{ $c->comprimento ? $c->comprimento : '' }}"
                                    onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" class="form-control"
                                    value="{{ $c->comprimento ? $c->comprimento : '' }}">
                                <input name="peso" type="number" placeholder="Peso {{ $c->peso ? $c->peso : '' }}"
                                    class="form-control" value="{{ $c->peso ? $c->peso : '' }}">
                                <button type="button" onclick='post_medidas(<?php echo $c->id; ?>)''
                                    class="btn btn-outline-primary">Confirmar</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                    </div>

                    {{-- </form> --}}
                </div>
        @endif
    </div>

    <script src="{{ asset('js/servicos/correios.js') }}" defer></script>
    <script src="{{ asset('js/admin/configuracoes/configEnvio.js') }}" defer></script>

@endsection
