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
                    @if (auth()->user())
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                    @else
                    <h5 class="card-title">Você não possui registro em nossa loja</h5>
                    <p class="card-text">Para detalhes de endereço, prazo de entrega, confirmação de pedido e realizar o pagamento é necessário se cadastrar em nossa loja</p>
                    <a href="#" class="btn btn-primary">Cadastrar</a>
                    @endif
                   
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/usuario/finalizaVenda.js') }}"></script>
