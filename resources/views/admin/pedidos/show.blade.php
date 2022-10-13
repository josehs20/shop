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

    /* .tabelaPedido{
        border: 1px solid black !important;
        border-radius: 20px !important;

    } */
</style>

@section('content')
    <!-- DIV PAI PARA DIV FILHA DE CADASTRAR(E) E LISTAR(L) CATEGORIAS -->

    <body onload='total_frete_subtotal_calculo(null, <?php echo $pedido->id; ?>)'>
        <div class="divPaiCL">
            <div>
                <div class="card mb-3 cadastrarCores">

                    <h5 class="card-header d-flex justify-content-between">
                        Status do pedido:
                    </h5>
                    <div class="card-body">
                        <select class="form-select mb-3" aria-label="Default select example">
                            <option selected>{{ formata_status($pedido->status) }}</option>
                            @foreach ($status as $s)
                                <option value="1">{{ formata_status($s) }}</option>
                            @endforeach
                        </select>
                        <h6>Codigo de rastreio</h6>
                        @if (!$pedido->codRastreio)
                            <form onsubmit="post_codigo_rastreio(<?php echo $pedido->id; ?>); return false;" method="POST"
                                class="input-group mb-3">
                                @csrf
                                <input required type="text" class="form-control" id="inputCodRastreio"
                                    placeholder="codigo de rastreio" aria-label="Username" aria-describedby="basic-addon1">
                                <button type="submit" id="buttonRastreio"
                                    class="btn btn-outline-primary">Cadastrar</button>
                            </form>
                        @else
                            <div class="input-group mb-3">
                                <input disbled required type="text" value="{{ $pedido->codRastreio }}"
                                    class="form-control" id="inputCodRastreio" placeholder="codigo de rastreio"
                                    aria-label="Username" aria-describedby="basic-addon1">
                                <button disabled type="submit" id="buttonRastreio"
                                    class="btn btn-outline-primary">Consultar</button>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="card mb-3 cadastrarCores">

                    <h5 class="card-header d-flex justify-content-between">
                        Endereço de entrega:
                    </h5>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rua:
                                <h6 class="">{{ $pedido->endereco->rua }}</h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Numero:
                                <h6 class="">{{ $pedido->endereco->numero ? $pedido->endereco->numero : 'S/N' }}</h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Bairro:
                                <h6 class="">{{ $pedido->endereco->bairro }}</h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Cidade:
                                <h6 class="">{{ $pedido->endereco->cidade }} / {{ $pedido->endereco->estado }}</h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Complemento:
                                <h6 class="">{{ $pedido->endereco->complemento }}</h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Referência:
                                <h6 class="">{{ $pedido->endereco->referencia }}</h6>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Cep:
                                <h6 class="">{{ $pedido->endereco->cep }}</h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- LISTA DE CATEGORIAS -->
            <div class="card listarEstoque">
                <div>
                    @csrf
                    <div class="card-header d-flex justify-content-between search">
                        <h5>Pedido: Nº {{ $pedido->numero_pedido }}</h5>
                        {{-- <h5>{{ $pedido->users->name }}</h5> --}}
                    </div>



                    <div class="d-flex justify-content-between mx-3 my-4" style="flex-wrap:wrap">
                        <div class="list-group mx-auto mt-2">
                            <a class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Cliente:</h5>
                                    <h6>{{ $pedido->users->name }}</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <h5 class="mb-1">Telefone: </h5>
                                    <h6>{{ $pedido->users->telefone }}</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <h5 class="mb-1">Tipo de pagamento: </h5>
                                    <h6>pix,cartao,etc...</h6>
                                </div>

                            </a>
                        </div>

                        <div class="list-group mx-auto mt-2" style="height: fit-content !important;">
                            <a class="list-group-item list-group-item-action" aria-current="true">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Data de compra</h5>
                                    <h6>{{ date('d/m/Y', strtotime($pedido->data)) }}</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Frete: </h5>
                                    <h6 id="freteElement">Carregando...</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <h5 class="mb-1">Subtotal: </h5>
                                    <h6 id="subTotal">{{ 'R$ ' . reais($pedido->valor_total) }}</h6>
                                </div>
                                <div class="d-flex w-100 justify-content-between mt-2">
                                    <h5 class="mb-1">Total: </h5>
                                    <h6 id="totalValor">Carregando...</h6>
                                </div>
                            </a>
                        </div>
                    </div>


                    <div id="divTabelaPedido" class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Tamanho</th>
                                    <th scope="col">Cor</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preco unitário</th>
                                    <th scope="col">Preço</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pedido->pedido_itens as $item)
                                    <tr>
                                        {{-- <th scope="row">1</th> --}}
                                        <td>{{ $item->ptc->produto->nome }}</td>
                                        <td>{{ $item->ptc->tamanho->nome }}</td>
                                        <td>{{ $item->ptc->cor->nome }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td>{{ 'R$ ' . reais($item->ptc->preco) }}</td>
                                        <td>{{ 'R$ ' . reais($item->ptc->preco * $item->quantidade) }}</td>
                                    </tr>
                                @endforeach
                        </table>
                        {{-- <div class="col-md-12">

                        <div class="mt-4">
                            <h4>Calcule o Frete</h4>
                            <form onsubmit="calcula_frete(); return false;" method="GET" class="form-inline">
                                <input placeholder="99999-999" type="text" onkeyup="mascaraCep('calculaCepInput')"
                                    id="calculaCepInput" class="form-control col-md-6 mr-3">
                                <button type="submit" class="btn btn-outline-success">Calcular</button>
                            </form>
                            <label class="d-none avisoCep" for="">Cep contem 9 digitos</label>
                        </div>

                    </div> --}}
                    </div>
                </div>



                <style>
                    #form-checkout {
                        display: flex;
                        flex-direction: column;
                        max-width: 600px;
                    }

                    .container {
                        height: 18px;
                        display: inline-block;
                        border: 1px solid rgb(118, 118, 118);
                        border-radius: 2px;
                        padding: 1px 2px;
                    }
                </style>
                <form id="form-checkout">
                    <div id="form-checkout__cardNumber" class="container"></div>
                    <div id="form-checkout__expirationDate" class="container"></div>
                    <div id="form-checkout__securityCode" class="container"></div>
                    <input type="text" id="form-checkout__cardholderName" />
                    <select id="form-checkout__issuer"></select>
                    <select id="form-checkout__installments"></select>
                    <select id="form-checkout__identificationType"></select>
                    <input type="text" id="form-checkout__identificationNumber" />
                    <input type="email" id="form-checkout__cardholderEmail" />

                    <button type="submit" id="form-checkout__submit">Pagar</button>
                    <progress value="0" class="progress-bar">Carregando...</progress>
                </form>




            </div>

        </div>




        <script src="https://sdk.mercadopago.com/js/v2"></script>


        <script src="{{ asset('js/admin/pedidos/show.js') }}" defer></script>

        <script src="{{ asset('js/servicos/pagamentos.js') }}" defer></script>

        <script src="{{ asset('js/servicos/correios.js') }}" defer></script>
    @endsection
