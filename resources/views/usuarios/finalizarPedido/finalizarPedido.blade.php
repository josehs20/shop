@extends('layouts.baseUsuario')

@section('conteudo')
    <style>
        .div-filtro {
            display: none;
        }
    </style>

    <div class="row">
        <div class="col-md-8">
            <div class="card" id="carViewFinalizaPedido">
                <div class="d-flex card-body">
                    <div class="card mb-3 col-8" style="max-height: 150x;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/storage/imageProduto/1/calca2.jpeg" class="img-fluid rounded-start" alt="..."
                                    style="height: 150px;">
                            </div>
                            <div class="col-md-8">
                                {{-- Monta a listagem aqui pelo js --}}
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 mx-2 col-4" style="max-height: 150x;">
                        <div class="d-flex align-items-center mt-3 mx-2">
                            <h5 id="carrinhoTamanhoProduto">Valor: &emsp;</h5>
                            <h4> Nome item </h4>
                        </div>
                        <div class="d-flex align-items-center mt-3 mx-2">
                            <h5 id="carrinhoTamanhoProduto">Quantidade: &emsp;</h5>

                            <div class="input-group mb-3 mx-2">
                                <button class="btn btn-outline-secondary" type="button">+</button>

                                <input class="col-3" type="text" value="1" class="form-control" placeholder=""
                                    aria-label="Example text with two button addons">
                                <button class="btn btn-outline-secondary" type="button">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">Detalhes da compra</h5>
                <div class="card-body">
                    <h5 id="vTotal" class="card-title">Valor total : </h5>
                    <h5 id="qtdItens" class="card-title"></h5>
                    @if (!auth()->user())
            
                    <h5 class="card-title">Você não possui registro em nossa loja</h5>
                    <p class="card-text">Para detalhes de endereço, prazo de entrega, confirmação de pedido e realizar o
                        pagamento é necessário se cadastrar em nossa loja</p>
                        
                    <a href="{{ route('register') }}" class="btn btn-primary">Cadastrar</a>
                  
                    @endif

                </div>
            </div>
            @if (auth()->user())
                <div class="card mt-4">
                    <h5 class="card-header">Detalhes do envio</h5>
                    <div class="card-body">


                        @if (!count($enderecos))
                            <h6 class="card-title">Você não tem nenhum endereco registrado para envio, deseja cadastrar
                                algum endereço padrão ?</h6>
                        @endif
                    </div>
                </div>
            @endif
            <div class="card mt-4">
                <h5 class="card-header">Calcular frete</h5>
                <div class="card-body">
                    <form onsubmit="calcula_frete(); return false;" method="GET">
                        <h5 class="card-title">Calcular frete :</h5>
                        <input placeholder="99999-999" type="text" onkeyup="mascaraCep('calculaCepInput')"
                            id="calculaCepInput" class="form-control col-md-6 mr-3">
                        <button type="submit" class="btn btn-outline-success mt-3">Calcular</button>
                    </form>
                    <label class="d-none avisoCep" for="">Cep contem 9 digitos</label>


                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/usuario/finalizaVenda.js') }}"></script>
