<div class="collapse" id="cadastroDeProdutos">
    <div class="card-body">
        <div class="input-group mb-2 inome">
            <span class="input-group-text" id="basic-addon1"><i class="fab fa-product-hunt"></i></span>
            <input type="text" class="form-control" placeholder="Nome do produto" name="nome">
        </div>
        <div class="input-group mb-2 inumero">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
            <input required onkeyup="calcula_lucro(), mascaraDinheiro('inputCusto')" type="text"
                class="form-control inputCusto" placeholder="Custo" name="custo">
        </div>
        <div class="input-group mb-2 inumero">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
            <input required onkeyup="calcula_lucro(), mascaraDinheiro('inputPreco')" type="text"
                class="form-control inputPreco" placeholder="Preço" name="preco">
        </div>
        <div class="input-group mb-2 inumero">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-percent"></i></span>
            <input readonly type="text" class="form-control" placeholder="Lucro" name="lucro">
        </div>

        <select name="categoria" class="form-select icategoria" aria-label="Default select example">
            @foreach ($categorias as $cat)
                <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
            @endforeach
        </select>
        <select name="cor" class="form-select icor" aria-label="Default select example">
            @foreach ($cores as $c)
                <option value="{{ $c->id }}">{{ $c->nome }}</option>
            @endforeach
        </select>
        <select name="tamanho" class="form-select itamanho" aria-label="Default select example">
            @foreach ($tamanhos as $t)
                <option value="{{ $t->id }}">{{ $t->nome }}</option>
            @endforeach
        </select>
        <div class="input-group mb-2 iestoque">
            <span class="input-group-text" id="basic-addon1"><i class="fa fa-memory"></i></span>
            <input required name="estoque" type="number" class="form-control" placeholder="Estoque" name="estoque">
        </div>

        <input id="imagensProduto" name="imagens[]" required type="file" class="form-control disabledInsert iimagem"
            id="imagensProdutoValue" accept="image/*" multiple placeholder="Imagem">
    </div>
    {{-- div usada somente para update de produto, onde lista ptc do produto --}}
    <div class="d-none" id="tabelaProdutoUpdate"></div>

    <div class="card-footer">
        <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
        <div>
            <!-- BOTOES FICAM AQUI -->
            @if (count($produto))
                <button type="button" class="btn btn-outline-primary" onclick="alert_editar_ptc()">Adicionar</button>
            @else
                <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
            @endif

            <button type="reset" onclick="habilitainputs()"
                class="btn btn-outline-secondary {{ count($produto) ? 'd-none' : '' }}">Limpar campos</button>
        </div>
    </div>
</div>
