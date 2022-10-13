function get_pedidos(id) {

    $.ajax({
        url: '/get_pedidos',
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { id },
        dataType: 'json',
        success: function (resp) {
            monta_lista_pedidos(resp)
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}

async function total_frete_subtotal_calculo(cep, id_pedido) {
    //converte valores e soma 'subtotal' com frete/ subtotal sendo total em pedidos no bd
    var response = await calcula_frete(cep, id_pedido)

    document.getElementById('freteElement').innerHTML = formata_dinheiro(parseFloat(response.pac.Valor.replace('.', '').replace(',', '.')))
    var subTotal = parseFloat($('#subTotal').text().replace('R$', '').replace('.', '').replace(',', '.'));
    var frete = parseFloat(response.pac.Valor.replace('.', '').replace(',', '.'))
    document.getElementById('totalValor').innerHTML = formata_dinheiro(frete + subTotal)
}

function post_codigo_rastreio(id_pedido) {
    var codigo = document.getElementById('inputCodRastreio').value;

    $.ajax({
        url: '/post-codigo-rastreio',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { codigo: codigo, id_pedido: id_pedido },
        dataType: 'json',
        success: function (resp) {
            if (resp.valido == true) {
                alerta_simples('success', resp.msg)
                document.getElementById('buttonRastreio').setAttribute('disabled', true)
            } else {
                alerta_simples('error', resp.msg)
            }
        },
        error: function (errors) {
            alerta_simples('error', 'Algo deu errado tente novamente em alguns instantes')
        }
    })
}
function get_rastreio_pedido(id_input) {
    var local = rastreia_pedido(id_input)
    console.log(local);
}
//função anonima para verificar se deve ou não consultar os correio quando entra na pagina
$(function () {
    var inputRastreio = document.getElementById('inputCodRastreio').value ? 'inputCodRastreio' : false

    if (inputRastreio) {
     //  console.log(inputRastreio);
    }
})

