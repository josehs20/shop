function post_produto() {
    const formData = new FormData(document.querySelector('#formCadastroProduto'));

    var imagens = document.getElementById('imagensProduto').files
    if (imagens.length > 5) {
        alerta('info', 'Limite inválido', 'Limite de 5 imagens, para melhor desempenho da plataforma', true)
        return;
    }

    axios.post('/cadastro/produto', formData)
        .then(response => {
            console.log(response);
            document.querySelector('select[name="categoria"]').disabled = true;
            alerta('success','', response.data.msg, true);
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
        var valor = ((preco - custo) / preco) * 100;
        lucro.value = valor.toFixed(2);
    }



}

function get_produtos() {
    var nome = document.getElementById('inputPesquisarProduto').value;

    axios.get('/get_produtos', { params: { nome: nome } })
        .then(response => {
            if (response.data.length) {
                monta_lista_produtos(response.data);
            } else {
                div_nao_contem_registro('divListaProdutos', 'Nenhum produto encontrado.');
            }
        })
        .catch(response => {
            alerta('error', 'Não foi possível buscar os produtos, tente novamente mais tarde.')
        })
}
get_produtos();

function monta_lista_produtos(produtos) {
    //funcao chamada
}
