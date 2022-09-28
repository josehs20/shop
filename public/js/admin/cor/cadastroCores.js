function post_cores() {
    var attrs = {
        codigo: document.querySelector('input[name="codigo"]').value,
        nome: document.querySelector('input[name="nome"]').value
    }
    $.ajax({
        url: '/cor',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: attrs,
        dataType: 'json',
        success: function (response) {
            get_cores()
            alerta('success', response, '', false)
        },
        error: function (errors) {
            var resp = errors.responseJSON.message.split(":")
            if (resp[0] == "SQLSTATE[23000]") {
                alerta('error', 'Esta cor já existe!', '', false)
            } else {
                alerta('error', 'Ocorreu algum erro. Tente novamente em alguns instantes', '', false)
            }
        }
    })
}

function get_cores() {
    axios.get('/get_cores')
        .then(response => {
            if (response.data.length) {
                monta_lista_cores(response.data);
            } else {
                div_nao_contem_registro('divListaCores', 'Nenhuma cor encontrada.');
            }
        })
        .catch(response => {
            alerta('error', 'Não foi possível buscar as cores, tente novamente mais tarde.', '', false)
        })
}
get_cores()

function monta_lista_cores(cores) {
    var count = 1
    document.getElementById('divListaCores').innerHTML = `<table class="table table-hover"><thead><tr><th scope="col">#</th> <th scope="col">Cor</th><th scope="col">Nome</th><th scope="col"></th></tr></thead><tbody id="tabelaCor"></tbody></table>`
    var bodyTabela = document.getElementById('tabelaCor')
    linhaTabela = ''
    cores.forEach(cor => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td><input type="color" value="${cor.codigo}"></td>
        <td>${cor.nome}</td>
        <td class="col-1">
            <button onclick='confirmar_exclusao(${cor.id}, "/cor/", get_cores, "Deseja realmente excluir a cor ${cor.nome}")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
        count++
    });

    bodyTabela.innerHTML = linhaTabela
}
