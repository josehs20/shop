//CODIGOS PARA ABRIR E FECHAR A SIDEBAR
var conteudoSidebar = document.getElementById('conteudoSidebar')
var abrirSidebar = document.getElementById('bmenu')
var fecharSidebar = document.getElementById('fecharSidebar')

abrirSidebar.addEventListener("click", () => {
    conteudoSidebar.classList.toggle('mostrarSidebar')
})

fecharSidebar.addEventListener("click", () => {
    conteudoSidebar.classList.toggle('mostrarSidebar')
})