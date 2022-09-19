function alerta(icone, title, texto, confirmButton) {
    var button_confirm = confirmButton ? confirmButton : false;
    var texto = texto ? texto : '';
    var timer = confirmButton ? 10000 : 2000
    Swal.fire({
      icon: icone,
      title: title,
      text: texto,
      showConfirmButton: button_confirm,
      timer: timer
    })
}

//ALERTA QUE CONFIRMA ANTES DE EXCLUIR PARA O USUARIO TER CERTEZA
//ELA CHAMA A FUNÇÃO DE EXCLUIR(no arquivo princinpalBackEnd.js) QUANDO O USUARIO CONFIRMA QUE QUER EXCLUIR
function confirmar_exclusao(elemento, rota, funcaoGetElementos, objeto) {
  Swal.fire({
      title: `Deseja realmente excluir ${objeto} ${elemento.nome}?`,
      showCancelButton: true,
      confirmButtonText: 'Confirmar',
  }).then((result) => {
      if (result.isConfirmed) {
          excluir_elemento(elemento.id, rota, funcaoGetElementos)
      }
  })
}