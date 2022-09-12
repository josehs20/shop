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