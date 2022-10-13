//CODIGOS PARA ABRIR E FECHAR A SIDEBAR
var conteudoSidebar = document.getElementById('conteudoSidebar')//app.blade
var abrirSidebar = document.getElementById('bmenu')//botao de menu na navbar
var fecharSidebar = document.getElementById('fecharSidebar')//botao de fechar dentro da sidebar

abrirSidebar.addEventListener("click", () => {
    conteudoSidebar.classList.toggle('mostrarSidebar')
})

fecharSidebar.addEventListener("click", () => {
    conteudoSidebar.classList.toggle('mostrarSidebar')
})

//var rotate = 0;
function rotacionarElemento(elemento) {
    var elemento = document.getElementById(elemento);
    if (!elemento.style.transform) {
        //   rotate = 180
        elemento.style.transform = "rotate(" + 180 + "deg)";
    } else {
        //rotate = 0
        elemento.style.transform = "rotate(" + 0 + "deg)";
        elemento.removeAttribute("style")
    }
}

function div_nao_contem_registro(elemento, texto) {
    var div = document.getElementById(elemento)
    div.innerHTML = `<div class="alert alert-info mx-auto" role="alert">${texto}</div>`;
}

function mascaraDinheiro(input) {
    return $(`.${input}`).mask('#.##0,00', { reverse: true });
}

function monta_html_list_group(dados, titulo) {
    var html = `<div class="card"><div class="card-header">${titulo}</div><div class="card-body"><table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col"></th>
        <th scope="col">Estoque</th>
      </tr>
    </thead>
    <tbody>`
    var count = 1;
    //NECESSÁRIO PASSAR UM ARRAY MESMO QUE CONTENHA UM OBJETO SÓ PARA FUNCAO computa_produtos FUNCIONAR
    computa_produtos(dados).forEach(element => {
        html += `
            <tr>
              <th scope="row">${count}</th>
              <td colspan="2">${element.nome}</td>
              <td >${element.totalEstoque}</td>
            </tr>`
        count++
    });
    html += `</tbody></table>`
    return html;
}

function habilitainputs() {
    document.querySelector("select[name='categoria']").disabled = false;
    document.querySelector("#imagensProduto").disabled = false
    document.querySelector("input[name='nome']").readOnly = false;
}

function selecionar(elemento) {
    // var itemm = elemento.id.split('_')

    // elemento.classList.toggle('marcar')
    // var produto = document.getElementById('buttonCarrinho').getAttribute('data-produto')
    // console.log(produto);
    // var produtoStorage = localStorage.getItem('ptcUnicoProduto') ?
    //     JSON.parse(localStorage.getItem('ptcUnicoProduto')) : [{}]

    // if (itemm[0] == 't') {
    //     produtoStorage.tamanhoID = itemm[1]
    // } else if (itemm[0] == 'c') {
    //     ptcUnicoProduto.corID = itemm[1]
    //     ptcUnicoProduto.corValue = elemento.value
    // }

    // localStorage.setItem('ptcUnicoProduto', JSON.stringify(ptcUnicoProduto));


}
