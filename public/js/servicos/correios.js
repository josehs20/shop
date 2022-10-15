function calcula_frete(cep, id_pedido) {
    var data = { cep, id_pedido }
    var response = ''
    $.ajax({
        url: '/api/calcula-frete',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'json',
        async: false,
        data: data,
        success: function (resp) {
            response = resp
        },
        error: function (resp) {
            response = resp
        }
    })
    return response.data
}

//passar o id do input onde o codigo de rastreio está
function rastreia_pedido(id_input) {
    var codigo = document.getElementById(id_input).value;
    var response = ''
    $.ajax({
        url: '/api/rastreio-pedido',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'json',
        async: false,
        data: { codigo: codigo },
        success: function (resp) {
            console.log('asdas');
            console.log(resp);
            response = resp
        },
        error: function (erros) {
            return erros;
        }
    })
    return response
}

function mascaraCep(cep) {
    return $('#' + cep).mask('00000-000', { reverse: true });
}