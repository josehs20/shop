function calcula_frete() {

    $.ajax({
        url: '/api/calcula-frete',
        method: 'GET',
        dataType: 'json',
        // data:{cep},
        success: function (resp) {
            console.log(resp);
        },
        error: function (erros) {
            console.log(erros);
        }
    })
}
calcula_frete()