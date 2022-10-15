<style>
    .vcarrinho {
        background-color: #FFF;
        width: 40%;
        height: 100vh;
        overflow-y: scroll !important
    }

    .vcarrinho i {
        margin: 10px 0 0 10px;
    }

    .item-do-carrinho {
        border: 1px solid #ccc;
        padding: 10px 20px;
        margin: 0 20px;
        border-radius: 10px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 7px
    }

    .item-carrinho {
        width: 100%
    }

    .item-carrinho>div {
        margin-bottom: 7px;
    }

    .item-carrinho>div h6 {
        margin: 0 !important;
    }

    .imagem-do-item img {
        width: 110px;
    }

    @media(max-width: 860px) {
        .vcarrinho {
            background-color: #FFF;
            width: 90%;
            height: 100vh;
        }
    }
</style>

<div class="vcarrinho">
    {{-- BOTAO DE FECHAR O CARRINHO --}}
    <i class="fa fa-times" onclick="abrirFecharCarrinho()"></i>
    <br>
    <br>
    <div id="divPaiCarrinhoItens">
        
    </div>
    <div id="finalizarPedidoButton" class="d-flex justify-content-center mt-5 mb-3">
        <a href="{{ route('finalizarPedido') }}" class="btn btn-outline-success w-50"> Finalizar pedido </a>
    </div>

</div>

