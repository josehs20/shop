// var formularioListaCategorias = document.getElementById('formListaDeCategorias')
// formularioListaCategorias.addEventListener('submit', e => {
//     e.preventDefault()
//     var inputPesquisa = document.getElementById('inputPesquisarCategoria').value;    
//     console.log(inputPesquisa)
// })

function post_categorias() {
    const formData = new FormData(document.querySelector('#formCadastrarCategoria'))
    axios.post('/cadastro/categoria', formData)
        .then(response => {
            get_categorias()
            alerta('success', response.data, '', false)
        })
        .catch(errors => {
            var resp = JSON.parse(errors.response.request.responseText)
            resp = resp.message.split(":")
            if(resp[0] == "SQLSTATE[23000]"){
                alerta('error', 'Esta categoria já existe!', '', false)
            } else {
                alerta('error', 'Ocorreu algum erro.', '', false)
            }
        })
}

function get_categorias() {
    axios.get('/get_categorias')
        .then(response => {
            if (response.data.length) {
                monta_lista_categorias(response.data);
            } else {
                div_nao_contem_registro('divListaCategorias', 'Nenhuma categoria encontrada.');
            }
        })
        .catch(response => {
            alerta('error', 'Não foi possível buscar as categorias, tente novamente mais tarde.', '', false)
        })
}
get_categorias()

function monta_lista_categorias(categorias) {
    var count = 1
    var bodyTabela = document.getElementById('tabelaCategoria')
    linhaTabela = ''
    categorias.forEach(categoria => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td>${categoria.nome}</td>
        <td class="col-1">
            <button onclick='confirmar_exclusao(${JSON.stringify(categoria)}, "/cadastro/categoria/", "get_categorias", "a categoria")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
    count++
    });
    bodyTabela.innerHTML = linhaTabela
}