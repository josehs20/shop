<style>
    .vcarrinho {
        background-color: #FFF;
        width: 40%;
        height: 100vh;
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
            <h3>Nome do produto</h3>
            {{-- TAMANHO --}}
            <div class="d-flex align-items-center">
                <h6>Tamanho: &emsp;</h6>
                <h5> M </h5>
            </div>
            {{-- CORES --}}
            <div class="d-flex align-items-center">
                <h6>Cor: &emsp;</h6>
                <input type="color" value="#000">
            </div>
            {{-- QUANTIDADE --}}
            <div class="d-flex align-items-center">
                <h6>Quantidade: &emsp;</h6>
                <h5>2</h5>
            </div>
        </div>
        {{-- IMAGEM DE PRIORIDADE DO PRODUTO --}}        
        <div class="imagem-do-item d-flex align-items-center">
            {{-- <img src="{{ asset('storage/' .$produtoIndividual->first()->imagens->where('prioridade', 1)->first()->nome) }}"
                class="d-block" alt="Imagem do produto"> --}}
        </div>
    </div>
</div>
