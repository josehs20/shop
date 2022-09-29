       <!-- DIV PAI PARA DIV FILHA DE CADASTRAR(E) E LISTAR(L) CATEGORIAS -->
       <div class="divPaiCL">
        <!-- ESTOQUE -->
        <div class="card mb-3 cadastrarCores">
            <h5 class="card-header d-flex justify-content-between">
                Buscar por:
            </h5>
            <div class="card-body">
                <div id="filtrosEstoque">
                    <a onclick="modal_get_itens_filtro('categoria_id')"><p class="opcoes d-flex"><i class="fa fa-flag"></i>&emsp;Categoria</p></a>
                    <a onclick="modal_get_itens_filtro('tamanho_id')"><p class="opcoes d-flex"><i class="fa fa-text-height"></i>&emsp;Tamanho</p></a>
                    <a onclick="modal_get_itens_filtro('cor_id')"><p class="opcoes d-flex"><i class="fa fa-pen-nib"></i>&emsp;Cor</p></a>
                    <a onclick="modal_get_itens_filtro('quantidade')"><p class="opcoes d-flex"><i class="fa fa-sort-numeric-down"></i>&emsp;Quantidade no estoque</p></a>
                </div>
            </div>
        </div>

        <!-- LISTA DE CATEGORIAS -->
        <div class="card listarEstoque" >
            <form onsubmit="modal_get_itens_filtro('nome'); return false;" id="formListaEstoque" method="GET">
                @csrf
                <div class="card-header search">
                    <h5>Estoque</h5>
                    <div class="input-group mb-3">
                        <!-- INPUT PARA PESQUISAR CATEGORIAS -->
                        <input id="inputPesquisarEstoque" type="search" class="form-control"
                            placeholder="Consultar estoque" aria-label="Consultar estoque">
                        <button class="input-group-text insearch" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <div id="divTabelaEstoque" class="card-body">
                </div>
                <div class="card-footer">
                </div>

            </form>
        </div>
    </div>