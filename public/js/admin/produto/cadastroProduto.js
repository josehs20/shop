function post_produto() {
    const formData = new FormData(document.querySelector('#formCadastroProduto'));

    var imagens = document.getElementById('imagensProduto').files
    if (imagens.length > 5) {
        alerta('info', 'Limite inválido', 'Limite de 5 imagens, para melhor desempenho da plataforma', true)
        return;
    }

    axios.post('/produto', formData)
        .then(response => {
            document.querySelector('select[name="categoria"]').disabled = true;
            document.getElementById('imagensProduto').disabled = true;
            document.querySelector('input[name="nome"]').setAttribute('readonly', true);
            get_produtos();
            alerta('success', '', response.data.msg, true);
        })
        .catch(errors => {
            if (errors.response.status == 422) {
                alerta('error', errors.response.data.msg, '', true);
            } else {
                alerta('error', 'Algo deu errado', 'Atualize a página e tente novamente', false);
            }
        })
}


function get_produtos() {
    var nome = document.getElementById('inputPesquisarProduto').value;

    $.ajax({
        url: '/get_produtos',
        method: 'GET',
        data: { nome: nome ? nome : '' },
        dataType: 'json',
        success: function (response) {
            var produtos = response.data
            if (Object.keys(produtos).length) {
                monta_lista_produtos(produtos);
            } else {
                div_nao_contem_registro('divListaProdutos', 'Nenhum produto encontrado.');
            }
        }
    });
}

get_produtos();

function monta_lista_produtos(produtos) {

    //MONTA CABEÇALHO
    var tabelaProdutos = `<div id="divListaProdutos" class="card-body"><table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Nome</th><th scope="col">Estoques</th><th scope="col">Editar</th><th scope="col">Detalhes</th></tr></thead><tbody id="tabelaProduto"></tbody></table></div>`
    var divTabelaProdutos = document.getElementById('divListaProdutos');
    divTabelaProdutos.innerHTML = tabelaProdutos;
    //DEPOIS DE MONTADA RECEBE TBODY DA TABELA PARA LISTAR OS PRODUTOS
    tabelaProdutos = divTabelaProdutos.querySelector('#tabelaProduto');
    var listProdutos = '';
    var count = 1;

    computa_produtos(produtos).forEach(element => {
        //MONTA AS IMAGENS PARA CADA COLLAPSE
        var imagens = ''
        element.imagens.forEach(img => {
            imagens += `
            <div style="cursor:pointer;" onclick='alerta_imagem("/storage/${img.nome}")' class="col-md-2">
                <div class="card h-100">
                 <img src="/storage/${img.nome}" class="card-img-top" alt="...">
                </div>
          </div>`
        });
        //MONTA TR DO COLLAPSE ANTES DE ENTRAR NAS CRASES 
        var tableColapse = ''
        element.attrs.forEach(attr => {
            var textoExclusao = `Deseja realmente excluir o produto ${element.nome}, do tamanho ${attr.tamanho} e cor ${attr.cor} ?`;
            var botao_delete = attr.estoque == 0 ? `<button onclick='confirmar_exclusao(${attr.ptcId}, "/estoque/", "get_produtos", "${textoExclusao}")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>`
                : `<button onclick='alerta("warning", "Atenção", "Contém ${attr.estoque} no seu estoque deste produto, é necessário zera-lo para excluir!!", ${true})' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>`
            tableColapse +=
                `<tr>
                    <td>${attr.cor}</td>
                    <td>${attr.tamanho}</td>
                    <td>${attr.estoque}</td>
                    <td class="col-1">
                        ${botao_delete}
                    </td>                    
                 </tr>`
        });

        //MONTA TODA A TABELA E INSERE COM innerHtml
        listProdutos += `<tr data-bs-toggle="collapse" href="#prod${element.id}"
        role="button" aria-expanded="false" aria-controls="prod" onclick="rotacionarElemento('iconProd${element.id}')">
        <td class="col-1">${count}</td>
        <td>${element.nome}</td>
        <td>${element.totalEstoque}</td>
        <td><a href="/produto/${element.id}/edit"><i class="fa fa-edit"></i></a></td>
        <td><i id="iconProd${element.id}" class="fa fa-long-arrow-alt-down"></i></td>
        </tr>
    <tr>
        <td colspan="5">
            <div class="collapse" id="prod${element.id}"> 
            <table class="table table-success table-striped">
            <thead>
              <tr>
                <th scope="col">Cor</th>
                <th scope="col">Tamanho</th>
                <th scope="col">Estoque</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            ${tableColapse}
            <tbody>
            </table> 
            <div class="row row-cols-1 row-cols-md-3 g-4">
            ${imagens}
            </div>
          </div>
        </td>
    </tr>`;
        count++
    });
    tabelaProdutos.innerHTML = listProdutos;
}
