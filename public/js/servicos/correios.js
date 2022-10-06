function calcula_frete(cep, id_pedido) {
    var data = {cep, id_pedido}
    $.ajax({
        url: '/api/calcula-frete',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'json',
         data: data ,
        success: function (resp) {
            console.log(resp);
        },
        error: function (erros) {
            console.log(erros);
        }
    })
}

function mascaraCep(cep) {
    return $('#'+cep).mask('00000-000',{reverse : true});
}