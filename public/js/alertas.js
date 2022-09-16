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