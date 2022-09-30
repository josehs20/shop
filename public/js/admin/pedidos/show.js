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

