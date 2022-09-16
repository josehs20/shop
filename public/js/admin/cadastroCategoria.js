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
            alerta('success', response.data)
        })
        .catch(errors => {
            var resp = JSON.parse(errors.response.request.responseText)
            resp = resp.message.split(":")
            if(resp[0] == "SQLSTATE[23000]"){
                alerta('error', 'Esta categoria já existe!')
            } else {
                alerta('error', 'Ocorreu algum erro.')
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
            alerta('error', 'Não foi possível buscar as categorias, tente novamente mais tarde.')
        })
}
get_categorias()

var count = 1
function monta_lista_categorias(categorias) {
    var bodyTabela = document.getElementById('tabelaCategoria')
    linhaTabela = ''
    categorias.forEach(categoria => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td>${categoria.nome}</td>
        <td class="col-1">
            <button onclick="excluirCategoria(${categoria.id})" type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
    count++
    });
    bodyTabela.innerHTML = linhaTabela
}

function excluirCategoria(categoriaID) {
    var formData = new FormData()
    formData.append('_method', 'delete')
    axios.post(`/cadastro/categoria/${categoriaID}`, formData)
        .then(response => {
            alerta('success', response.data)
            get_categorias()
        }).catch(errors => {
            console.log(errors);
        })
}