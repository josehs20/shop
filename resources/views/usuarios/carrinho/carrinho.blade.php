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
    <div class="item-do-carrinho">
        <div class="item-carrinho">
            {{-- NOME DO PRODUTO --}}
            <h3 id="carrinhoNomeProduto">Nome do produto</h3>
            {{-- TAMANHO --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoTamanhoProduto">Tamanho: &emsp;</h6>
                <h5> M </h5>
            </div>
            {{-- CORES --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoCorProduto">Cor: &emsp;</h6>
                <div style='border-radius: 27px; width: 20px; height: 20px; background-color:{{'#FFF'}}; border: 1px solid black'></div>
            </div>
            {{-- QUANTIDADE --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoQuantidadeProduto">Quantidade: &emsp;</h6>
                <h5>1</h5>
            </div>
        </div>
        {{-- IMAGEM DE PRIORIDADE DO PRODUTO --}}        
        <div class="imagem-do-item d-flex align-items-center">
            <img src="https://defrenteparaomar.com/wp-content/02-moda/202103-blusas-elegantes-1/cache/01-blusa-elegante-1.jpg-nggid049462-ngg0dyn-800x1800x100-00f0w010c010r110f110r010t010.jpg"
                class="d-block" alt="Imagem do produto">
        </div>
    </div>
    <div class="item-do-carrinho">
        <div class="item-carrinho">
            {{-- NOME DO PRODUTO --}}
            <h3 id="carrinhoNomeProduto">Nome do produto</h3>
            {{-- TAMANHO --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoTamanhoProduto">Tamanho: &emsp;</h6>
                <h5> PP </h5>
            </div>
            {{-- CORES --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoCorProduto">Cor: &emsp;</h6>
                <div style='border-radius: 27px; width: 20px; height: 20px; background-color:{{'#000'}}; border: 1px solid black'></div>
            </div>
            {{-- QUANTIDADE --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoQuantidadeProduto">Quantidade: &emsp;</h6>
                <h5>5</h5>
            </div>
        </div>
        {{-- IMAGEM DE PRIORIDADE DO PRODUTO --}}        
        <div class="imagem-do-item d-flex align-items-center">
            <img src="https://defrenteparaomar.com/wp-content/02-moda/202103-blusas-elegantes-1/cache/01-blusa-elegante-1.jpg-nggid049462-ngg0dyn-800x1800x100-00f0w010c010r110f110r010t010.jpg"
                class="d-block" alt="Imagem do produto">
        </div>
    </div>
    <div class="item-do-carrinho">
        <div class="item-carrinho">
            {{-- NOME DO PRODUTO --}}
            <h3 id="carrinhoNomeProduto">Nome do produto</h3>
            {{-- TAMANHO --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoTamanhoProduto">Tamanho: &emsp;</h6>
                <h5> M </h5>
            </div>
            {{-- CORES --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoCorProduto">Cor: &emsp;</h6>
                <div style='border-radius: 27px; width: 20px; height: 20px; background-color:{{'orangered'}}; border: 1px solid black'></div>
            </div>
            {{-- QUANTIDADE --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoQuantidadeProduto">Quantidade: &emsp;</h6>
                <h5>2</h5>
            </div>
        </div>
        {{-- IMAGEM DE PRIORIDADE DO PRODUTO --}}        
        <div class="imagem-do-item d-flex align-items-center">
            <img src="https://defrenteparaomar.com/wp-content/02-moda/202103-blusas-elegantes-1/cache/01-blusa-elegante-1.jpg-nggid049462-ngg0dyn-800x1800x100-00f0w010c010r110f110r010t010.jpg"
                class="d-block" alt="Imagem do produto">
        </div>
    </div>
    <div class="item-do-carrinho">
        <div class="item-carrinho">
            {{-- NOME DO PRODUTO --}}
            <h3 id="carrinhoNomeProduto">Nome do produto</h3>
            {{-- TAMANHO --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoTamanhoProduto">Tamanho: &emsp;</h6>
                <h5> G </h5>
            </div>
            {{-- CORES --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoCorProduto">Cor: &emsp;</h6>
                <div style='border-radius: 27px; width: 20px; height: 20px; background-color:{{'yellow'}}; border: 1px solid black'></div>
            </div>
            {{-- QUANTIDADE --}}
            <div class="d-flex align-items-center">
                <h6 id="carrinhoQuantidadeProduto">Quantidade: &emsp;</h6>
                <h5>2</h5>
            </div>
        </div>
        {{-- IMAGEM DE PRIORIDADE DO PRODUTO --}}        
        <div class="imagem-do-item d-flex align-items-center">
            <img src="https://defrenteparaomar.com/wp-content/02-moda/202103-blusas-elegantes-1/cache/01-blusa-elegante-1.jpg-nggid049462-ngg0dyn-800x1800x100-00f0w010c010r110f110r010t010.jpg"
                class="d-block" alt="Imagem do produto">
        </div>
    </div>

    <div class="d-flex justify-content-center mt-5 mb-3">
        <a href="{{route('finalizarPedido')}}" class="btn btn-outline-success w-50"> Finalizar pedido </a>
    </div>
    
</div>