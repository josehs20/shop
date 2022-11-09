function post_medidas(id) {
    var data = { largura: '', altura: '', comprimento: '', peso: '' }
    document.getElementById('divInputs' + id).querySelectorAll('input').forEach((element) => {
        switch (element.name) {
            case 'largura':
                data.largura = element.value
                break;
            case 'altura':
                data.altura = element.value
                break;
            case 'comprimento':
                data.comprimento = element.value
                break;
            case 'peso':
                data.peso = element.value
                break;
            default:
                break;
        }
    })
    if (data.largura && data.altura && data.comprimento && data.peso) {
        data.id = id
        $.ajax({
            url: '/post-medida-envio',
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: data,
            dataType: 'json',
            success: function (resp) {
                alerta_simples('success', 'Medida de envio alterada com sucesso !.')
            },
            error: function (erros) {
                alerta_simples('error', 'Não foi possível tente novamente em alguns instantes')

            }
        })
    } else {
        alerta('info', 'Todos os campos dessa categoria precisa ser preenchido', '', false);
    }
}
function exemplo_caixa() {
    Swal.fire({
        title: 'As medidas são unitárias, "Quanto ocupa um produto desta categoria em uma caixa?"',
        imageUrl: '/imagens/caixa-medida.jpg',
        imageWidth: 400,
        imageHeight: 200,
    })
}

function buscaCep(cep, inputCidade, inputUf) {
    var cep = mascaraCep(cep)
    cep = cep[0].value.replace('-', '')
    if (cep.length == 8) {
        $.ajax({
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            method: 'GET',
            dataType: 'json',
            success: function (resp) {
                console.log(resp);
                if (resp.erro == 'true') {
                    document.getElementById('botaoConfirmCep').setAttribute('disabled', true)
                    document.getElementById(inputCidade).value = '';
                    document.getElementById(inputUf).value = '';
                    document.getElementById('msgCep').style.color = 'red'
                    document.getElementById('msgCep').innerText = 'Cep não encontrado, verifique os digitos.'

                } else {
                    document.getElementById('botaoConfirmCep').removeAttribute('disabled')
                    document.getElementById('msgCep').innerText = ''
                    document.getElementById('msgCep').innerText = ''
                    document.getElementById(inputCidade).value = resp.localidade;
                    document.getElementById(inputUf).value = resp.uf;
                }

            },
            error: function (erros) {
                document.getElementById('botaoConfirmCep').setAttribute('disabled', true)
                document.getElementById(inputCidade).value = '';
                document.getElementById(inputUf).value = '';
                document.getElementById('msgCep').style.color = 'red'
                document.getElementById('msgCep').innerText = 'Cep não encontrado, verifique os digitos'
            }
        })
    } else {
        document.getElementById('botaoConfirmCep').setAttribute('disabled', true)
        document.getElementById(inputCidade).value = '';
        document.getElementById(inputUf).value = '';
        document.getElementById('msgCep').style.color = 'blue'
        document.getElementById('msgCep').innerText = 'Cep contém 8 digitos'
    }
}

function post_cep() {
    var data = {
        cep: document.getElementById('inputCep').value.replace('-', ''),
        cidade: document.getElementById('inputCidade').value,
        uf: document.getElementById('inputUf').value,
    }

    console.log(data);
    $.ajax({
        url: '/post-cep-envio',
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        success: function (resp) {
            console.log(resp);
            alerta_simples('success', 'Endereco de origem atualizado com sucesso !.')
        },
        error: function (erros) {
            alerta_simples('error', 'Não foi possível tente novamente em alguns instantes')

        }
    })
}
