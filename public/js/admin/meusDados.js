function atualizarMeusDados(id) {
    const formData = new FormData(document.getElementById('formMeusDados'))
    $.ajax({
        url: `/config/meusdados/${id}`,
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        dataType: 'json',
        success: function (response) {
          console.log(response);
        },
        error: function (errors) {
        console.log(errors);
        }
    })
}