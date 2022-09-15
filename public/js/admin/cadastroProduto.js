function post_produto() {
    //funcao para inserir produtos
}

function get_produtos() {
    var nome = 'Calça';
    axios.get('/get_produtos')
        .then(response => {
            if (response.data.length) {
                monta_lista_produtos(response.data);
            } else {
                div_nao_contem_registro('divListaProdutos', 'Nenhum produto encontrado');
            }
        })
        .catch(response => {
            alerta('error', 'Não foi possível buscar os produtos, tente novamente mais tarde')
        })

    // $.ajax({
    //     url: "/get_produtos",
    //     type: "GET",
    //     data: {
    //         nome: nome,
    //     },
    //     dataType: 'json',
    //     async: true,
    //     success: function (response) {
    //         console.log(response);
    //     },
    //     error: function (response){
    //         console.log(response);
    //     }
    // })
}
get_produtos()
function monta_lista_produtos(produtos) {
    //funcao chamada
}
