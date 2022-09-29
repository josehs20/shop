function get_pedidos(data) {

    $.ajax({
        url: '/get_pedidos',
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { data },
        dataType: 'json',
        success: function (resp) {
            monta_lista_pedidos(resp)
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}
get_pedidos();

function monta_lista_pedidos(pedidos) {
    document.getElementById('divTabelaPedido').innerHTML = `<table class="table table-hover"><thead><tr><th scope="col">Nº</th><th scope="col">Data</th><th scope="col">Valor</th></tr></thead><tbody id="tbodyTabelaPedido"></tbody></table>`;
    var tbodyTable = document.getElementById('tbodyTabelaPedido')
    var table = ''
    console.log(pedidos);
    //var dataBr = format_data(new Date(pedidos[0].data))
    pedidos.forEach(element => {
        table += `<tr>
        <th scope="row">${element.numero_pedido}</th>
        <td>${format_data(new Date(element.data))}</td>
        <td>${format_dinheiro(element.valor_total)}</td>
     
      </tr>`
    });

    tbodyTable.innerHTML = table


}