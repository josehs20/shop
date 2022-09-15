function post_produto() {
    //funcao para inserir produtos
}

var formularioListaProdutos = document.getElementById('formListaDeProdutos')
formularioListaProdutos.addEventListener('submit', e => {
    e.preventDefault()
    var inputPesquisa = document.getElementById('inputPesquisarProduto').value;    
    console.log(inputPesquisa)
    axios.get('/get_produtos')
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
})

function monta_lista_produtos(produtos) {
    //funcao chamada
}
