// var formularioListaCategorias = document.getElementById('formListaDeCategorias')
// formularioListaCategorias.addEventListener('submit', e => {
//     e.preventDefault()
//     var inputPesquisa = document.getElementById('inputPesquisarCategoria').value;    
//     console.log(inputPesquisa)
// })

function post_categorias() {
    const formData = new FormData(document.querySelector('#formCadastrarCategoria'))
    axios.post('/categoria', formData)
        .then(response => {
            console.log(response);
            get_categorias()
            alerta('success', response.data, '', false)
        })
        .catch(errors => {
            var resp = JSON.parse(errors.response.request.responseText)
            resp = resp.message.split(":")
            if (resp[0] == "SQLSTATE[23000]") {
                alerta('error', 'Esta categoria já existe!', '', false)
            } else {
                alerta('error', 'Ocorreu algum erro.', '', false)
            }
        })
}

function get_categorias() {
    var nome = document.getElementById('inputPesquisarCategoria').value;
    $.ajax({
        url: "/get_categorias",
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { nome: nome },
        dataType: 'json',
        success: function (resp) {
            if (resp.length) {
                monta_lista_categorias(resp);
            } else {
                div_nao_contem_registro('divListaCategorias', 'Nenhuma categoria encontrada.');
            }
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}
get_categorias()

function monta_lista_categorias(categorias) {
    var count = 1
    //insere o html para criar o html
    document.getElementById('divListaCategorias').innerHTML = `<table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Categoria</th><th scope="col"></th></tr></thead><tbody id="tabelaCategoria"> </tbody></table>`
    var bodyTabela = document.getElementById('tabelaCategoria')
    linhaTabela = ''
    categorias.forEach(categoria => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td>${categoria.nome}</td>
        <td class="col-1">
            <button onclick='confirmar_exclusao(${JSON.stringify(categoria)}, "/categoria/", "get_categorias", "a categoria")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
        count++
    });
    bodyTabela.innerHTML = linhaTabela
}