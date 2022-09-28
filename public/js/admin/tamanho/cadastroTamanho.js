// var formularioListaCategorias = document.getElementById('formListaDeCategorias')
// formularioListaCategorias.addEventListener('submit', e => {
//     e.preventDefault()
//     var inputPesquisa = document.getElementById('inputPesquisarCategoria').value;    
//     console.log(inputPesquisa)
// })

function post_tamanhos() {
    const formData = new FormData(document.querySelector('#formCadastrarTamanho'))
    axios.post('/tamanho', formData)
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
    var nome = document.getElementById('inputPesquisarTamanho').value;
    $.ajax({
        url: "/get_tamanhos",
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { nome: nome },
        dataType: 'json',
        success: function (resp) {
            if (resp.length) {
                monta_lista_tamanhos(resp);
            } else {
                div_nao_contem_registro('divListaTamanhos', 'Nenhum tamanho encontrado.');
            }
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}
get_tamanhos()

function monta_lista_tamanhos(tamanhos) {
    var count = 1
    document.getElementById('divListaTamanhos').innerHTML = `<table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Tamanho</th><th scope="col"></th></tr></thead><tbody id="tabelaTamanho"></tbody></table>`
    var bodyTabela = document.getElementById('tabelaTamanho')
    linhaTabela = ''
    tamanhos.forEach(tamanho => {
        linhaTabela += `
    <tr>
        <td class="col-1">${count}</td>
        <td>${tamanho.nome}</td>
        <td class="col-1">
            <button onclick='confirmar_exclusao(${JSON.stringify(tamanho)}, "/tamanho/", "get_tamanhos", "o tamanho")' type="submit" class="btn" style="border: none"><i class="fa fa-trash"></i></button>
        </td>
    </tr>`
        count++
    });
    bodyTabela.innerHTML = linhaTabela
}