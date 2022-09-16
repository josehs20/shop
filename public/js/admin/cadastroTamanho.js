// var formularioListaCategorias = document.getElementById('formListaDeCategorias')
// formularioListaCategorias.addEventListener('submit', e => {
//     e.preventDefault()
//     var inputPesquisa = document.getElementById('inputPesquisarCategoria').value;    
//     console.log(inputPesquisa)
// })

function post_tamanhos() {
    const formData = new FormData(document.querySelector('#formCadastrarTamanho'))
    axios.post('/cadastro/tamanho', formData)
        .then(response => {
            get_tamanhos()
            alerta('success', response.data, '', false)
        })
        .catch(errors => {
            var resp = JSON.parse(errors.response.request.responseText)
            resp = resp.message.split(":")
            if (resp[0] == "SQLSTATE[23000]") {
                alerta('error', 'Este tamanho já existe!', '', false)
            } else {
                alerta('error', 'Ocorreu algum erro.', '', false)
            }
        })
}

function get_tamanhos() {
    axios.get('/get_tamanhos')
        .then(response => {
            if (response.data.length) {
                monta_lista_tamanhos(response.data);
            } else {
                div_nao_contem_registro('divListaTamanhos', 'Nenhum tamanho encontrado.');
            }
        })
        .catch(response => {
            alerta('error', 'Não foi possível buscar os tamanhos, tente novamente mais tarde.', '', false)
        })
}
get_tamanhos()

function monta_lista_tamanhos(tamanhos) {
    var count = 1
    var bodyTabela = document.getElementById('tabelaTamanho')
    linhaTabela = ''
    tamanhos.forEach(tamanho => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td>${tamanho.nome}</td>
        <td class="col-1">
            <button onclick='confirmar_exclusao(${JSON.stringify(tamanho)}, "/cadastro/tamanho/", "get_tamanhos", "o tamanho")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
        count++
    });
    bodyTabela.innerHTML = linhaTabela
}