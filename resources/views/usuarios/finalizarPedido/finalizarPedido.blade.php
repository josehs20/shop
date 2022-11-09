@extends('layouts.baseUsuario')

@section('conteudo')
    <style>
        .div-filtro {
            display: none;
        }

        .btn-filtro {
            display: none;
        }

        .conteudo-principal {
            margin-left: 0;
        }

        .cards-lado-esquerdo {
            width: 66% !important;
        }

        .card-lado-direito {
            margin-top: 0 !important;
            width: 33% !important;
        }

        .produto-resumo {
            border: 1px solid #CCC;
            padding: 10px 20px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between
        }

        .card-finalizar-compra {
            height: fit-content !important;
            margin-top: 10px;
        }

        .pai-todos {
            display: flex;
            justify-content: space-between !important;
        }

        @media(max-width: 860px) {
            .pai-todos {
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
            }

            .card-finalizar-compra {
                margin-top: 10px;
            }

            .card-lado-direito {
                margin-top: 10px !important;
                width: 100% !important;
            }

            .cards-lado-esquerdo {
                width: 100% !important;
            }
        }
    </style>

    <h2>Finalizar compra</h2>
    <br>

    <div class="pai-todos">
        <div class="cards-lado-esquerdo">
            <!-- FORMAS DE PAGAMENTO -->
            <div class="card">
                <h5 class="card-header">Selecione uma forma de pagamento</h5>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="form-check">
                            <input checked class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Cartão
                            </label>
                        </div>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Boleto
                            </label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <select class="form-select" aria-label="Default select example">
                            <option selected value="1">Cartao um</option>
                            <option value="2">Cartao dois</option>
                            <option value="3">Cartao tres</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- RESUMO DA COMPRA -->
            <div class="card mt-3 card-resumo-compra">
                <h5 class="card-header">Resumo da compra</h5>
                <div class="card-body">
                    <!-- FOREACH  -->
                    <div class="mt-2 produto-resumo">
                        <div>
                            <h3>Blusa</h3>
                            <div class="d-flex align-items-center mt-2">
                                <p style="margin: 0 !important">Tamanho: </p>
                                <h5 style="margin: 0 !important"> &nbsp;M</h5>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <p style="margin: 0 !important">Cor: </p>
                                <div
                                    style="background-color: #000; width: 20px; height: 20px; border-radius: 27px; margin-left: 5px">
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <p style="margin: 0 !important">Quantidade: </p>
                                <h5 style="margin: 0 !important"> &nbsp;2</h5>
                            </div>
                        </div>
                        <div>
                            <h3>R$ 23,74</h3>
                            <img style="width: 100px;"
                                src="https://a-static.mlcdn.com.br/800x560/blusa-feminina-manga-longa-tule-gola-alta-malha-canelada-moda-filo/modabarata/c9f2464eeb0d11ebbf214201ac18500e/1da8d0ccdcd579fc36719c8cea79831c.jpeg"
                                alt="">
                        </div>
                    </div>

                    <!-- ENDFOREACH -->

                    <div class="mt-2 produto-resumo">
                        <div>
                            <h3>Blusa outra</h3>
                            <div class="d-flex align-items-center mt-2">
                                <p style="margin: 0 !important">Tamanho: </p>
                                <h5 style="margin: 0 !important"> &nbsp;P</h5>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <p style="margin: 0 !important">Cor: </p>
                                <div
                                    style="background-color: rgb(230, 0, 0); width: 20px; height: 20px; border-radius: 27px; margin-left: 5px; border: 1px solid black">
                                </div>
                            </div>
                            <div class="d-flex align-items-center mt-2">
                                <p style="margin: 0 !important">Quantidade: </p>
                                <h5 style="margin: 0 !important"> &nbsp;1</h5>
                            </div>
                        </div>
                        <div>
                            <h3>R$ 54,27</h3>
                            <img style="width: 100px;"
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT1L5vJNoxQR_cV0gvO14N6wHOPkv5KnzepXw&usqp=CAU"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-lado-direito">
            <!-- ENDEREÇO -->
            <div class="card card-endereco-entrega">
                <h5 class="card-header">Endereço de entrega</h5>
                <div class="card-body">
                    <select class="form-select" aria-label="Default select example">
                        <option selected value="1">Rua front end</option>
                        <option value="2">Rua front</option>
                        <option value="3">Rua end</option>
                    </select>

                    <br>

                    <div class="d-flex justify-content-between">
                        <h6>Rua: </h6>
                        <h5>Front End</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Nº: </h6>
                        <h5>111</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Bairro: </h6>
                        <h5>Centro</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>CEP: </h6>
                        <h5>28300-000</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Cidade: </h6>
                        <h5>Itaperuna</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>UF: </h6>
                        <h5>RJ</h5>
                    </div>

                </div>
            </div>
            <!-- FINALIZAR COMPRA -->
            <div class="card card-finalizar-compra">
                <h5 class="card-header">Detalhes da compra</h5>
                <div class="card-body">
                    {{-- <h5 class="card-title">Você não possui registro em nossa loja</h5> --}}
                    <h4>Resumo do pedido</h4>
                    <div class="d-flex justify-content-between">
                        <h6>Itens: </h6>
                        <h5>R$ 78,01</h5>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>Frete: </h6>
                        <h5>Grátis</h5>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h5>Total: </h5>
                        <h4>R$ 78,01</h4>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <p></p> <!-- APENAS PARA OCUPAR ESPAÇO E OS BOTOES FICAREM À DIREITA -->
                    <!-- BOTOES FICAM AQUI-->
                    <a href="#" class="btn btn-outline-success">Confirmar pedido</a>
                </div>
            </div>
        </div>

    </div>
@endsection
<script src="{{ asset('js/usuario/finalizaVenda.js') }}"></script>
