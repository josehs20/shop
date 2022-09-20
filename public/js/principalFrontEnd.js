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
  return $(`.${input}`).mask('#.##0,00', {reverse: true});
}
