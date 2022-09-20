function post_produto() {
    const formData = new FormData(document.querySelector('#formCadastroProduto'));

    var imagens = document.getElementById('imagensProduto').files
    if (imagens.length > 5) {
        alerta('info', 'Limite inválido', 'Limite de 5 imagens, para melhor desempenho da plataforma', true)
        return;
    }

    axios.post('/cadastro/produto', formData)
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

function calcula_lucro() {
    var preco = document.querySelector('input[name="preco"]').value
    var custo = document.querySelector('input[name="custo"]').value
    var lucro = document.querySelector('input[name="lucro"]')
    if (preco && custo) {
        preco = parseFloat(preco);
        custo = parseFloat(custo);
        var valor = ((preco - custo) / preco) * 100;
        lucro.value = valor.toFixed(2);
    }
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
    //monta cabeçalho da tabela
    var tabelaProdutos = `<div id="divListaProdutos" class="card-body"><table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Nome</th><th scope="col">Estoques</th><th scope="col">Detalhes</th></tr></thead><tbody id="tabelaProduto"></tbody></table></div>`
    var divTabelaProdutos = document.getElementById('divListaProdutos');
    divTabelaProdutos.innerHTML = tabelaProdutos;
    //depois de montada recebe tbody da tabela para listar os produtos
    tabelaProdutos = divTabelaProdutos.querySelector('#tabelaProduto');
    var listProdutos = '';
    var count = 1;
    computa_produtos(produtos).forEach(element => {
        console.log(element);
        listProdutos += `<tr data-bs-toggle="collapse" href="#prod${element.id}"
        role="button" aria-expanded="false" aria-controls="prod" onclick="rotacionarElemento('iconProd${element.id}')">
        <td class="col-1">${count}</td>
        <td>${element.nome}</td>
        <td>${element.totalEstoque}</td>
        <td><i id="iconProd${element.id}" class="fa fa-long-arrow-alt-down"></i></td>
    </tr>
    <tr >
    <div class="collapse" id="prod${element.id}"> tabelaproduto </div>
    </tr>`;
        count++
    });
    tabelaProdutos.innerHTML = listProdutos;


}
