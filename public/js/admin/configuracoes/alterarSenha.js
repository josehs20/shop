function atualizarSenhaUsuario(id, senhaAtual) {
    var senhas = {
        novaSenha: document.getElementById('novaSenha').value,
        password: senhaAtual
    }
        $.ajax({
            url: `/config/alterarsenha/${id}`,
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: senhas,
            dataType: 'json',
            success: function (response) {
                if (response.valido) {
                    document.getElementById('novaSenha').value = ''
                    document.getElementById('confirmaNovaSenha').value =''
                    alerta('success', response.msg, '', false)
                } else {
                    alerta('warning', response.msg, '', false)
                }
            },
            error: function (errors) {
                return errors;
            }
        });
}

function verificar_senhas(id, funcao){
    var novaSenha = document.getElementById('novaSenha').value
    var confirmaNovaSenha = document.getElementById('confirmaNovaSenha').value

    if(novaSenha){        
        if(confirmaNovaSenha){
            if(novaSenha === confirmaNovaSenha){
                confirmando_alteracao(id, funcao)
            }else{
                alerta_simples('warning', 'As senhas devem ser iguais!')
            }
        }else{
            alerta_simples('warning', 'Confirme a nova senha!')
        }
    }else{
        alerta_simples('warning', 'Digite uma nova senha!')
    }
}