// var formularioListaCategorias = document.getElementById('formListaDeCategorias')
// formularioListaCategorias.addEventListener('submit', e => {
//     e.preventDefault()
//     var inputPesquisa = document.getElementById('inputPesquisarCategoria').value;    
//     console.log(inputPesquisa)
// })

function post_cores() {
    const formData = new FormData(document.querySelector('#formCadastrarCor'))
    axios.post('/cadastro/cor/', formData)
        .then(response => {
            get_cores()
            alerta('success', response.data, '', false)
        })
        .catch(errors => {
            var resp = JSON.parse(errors.response.request.responseText)
            resp = resp.message.split(":")
            if (resp[0] == "SQLSTATE[23000]") {
                alerta('error', 'Esta cor já existe!', '', false)
            } else {
                alerta('error', 'Ocorreu algum erro.', '', false)
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
    var bodyTabela = document.getElementById('tabelaCor')
    linhaTabela = ''
    cores.forEach(cor => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td><input type="color" value="${cor.codigo}"></td>
        <td>${cor.nome}</td>
        <td class="col-1">
            <button onclick='confirmar_exclusao(${JSON.stringify(cor)}, "/cadastro/cor/", "get_cores", "a cor")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
        count++
    });
    bodyTabela.innerHTML = linhaTabela
}