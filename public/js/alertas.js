function alerta(icone, mensagem){
    Swal.fire({
        icon: icone,
        title: mensagem,
        showConfirmButton: false,
        timer: 1500
      })
}