function atualizarMeusDados() {
console.log(document.getElementById('nomeUsuario').value,document.getElementById('emailUsuario').value);
    $.ajax({
        url: '/config/meusdados',
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            nome: 'asdasd',
            email: 'dafasfasd2'
        },
        dataType: 'json',
        success: function (response) {
            console.log(response);
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}