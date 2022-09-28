function atualizarMeusDados(id, senha) {
    var usuario = { 
                    name: document.getElementById('nomeUsuario').value, 
                    email: document.getElementById('emailUsuario').value,
                    password: senha 
                }
    $.ajax({
        url: `/config/alterarMeusDados/${id}`,
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: usuario,
        dataType: 'json',
        success: function (response) {
            if(response.valido){
                document.getElementById('navbarDropdown').innerHTML = response.nomeUsuario + ' '
                alerta('success', response.msg, '', false)
            } else {
                alerta('warning', response.msg, '', false)
            }
        },
        error: function (errors) {
            console.log('error: ', errors);
        }
    });
}