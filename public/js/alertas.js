function alerta(icone, title, texto, confirmButton) {
  var button_confirm = confirmButton ? confirmButton : false;
  var texto = texto ? texto : '';
  var timer = confirmButton ? 10000 : 4000
  Swal.fire({
    icon: icone,
    title: title,
    text: texto,
    showConfirmButton: button_confirm,
    timer: timer
  })
}

function alerta_simples(icone,titulo, tempo) {
  var tempo = tempo ? tempo : 3000;
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: tempo,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: icone,
    title: titulo
  })
}

//ALERTA QUE CONFIRMA ANTES DE EXCLUIR PARA O USUARIO TER CERTEZA
//ELA CHAMA A FUNÇÃO DE EXCLUIR(no arquivo princinpalBackEnd.js) QUANDO O USUARIO CONFIRMA QUE QUER EXCLUIR
function confirmar_exclusao(id, rota, funcaoGetElementos, texto) {
  Swal.fire({
    // title: `Deseja realmente excluir ${objeto} ${elemento.nome}?`,
    title: texto,
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
  }).then((result) => {
    if (result.isConfirmed) {
      excluir_elemento(id, rota, funcaoGetElementos)
    }
  })
}
//EXIBE IMAGEM EM SWAL
function alerta_imagem(caminho) {
  Swal.fire({
    imageUrl: caminho,
    imageHeight: 300,
    imageAlt: 'Imagem produto'
  })
}
/*CASO NECESSITE APRESENTAR  PRODUTOS RELACIONADOS AO PTC,
  QUANDO OUVER TENTATIVA DE EXCLUSÃOE O PRODUTO TIVER ALGUM VINCULO COM ESTOQUE OU PRODUTO
*/
function alerta_contem_produto_vinculado(html, title, texto) {
  Swal.fire({
    title: `<h2>${title}</h2><br><h6>${texto}</h6>`,
    icon: 'info',
    html: html,
    showCancelButton: true,
    showConfirmButton: true,
    focusConfirm: true,
    confirmButtonText:
      `<a href="/estoque">Ir para estoque</a>`,
    cancelButtonText:
      '<h6>Fechar</h6>',
  })
}

//CASO O PAREMETRO PTC SEJA FALSO ELE VAI CRIAR UM NOVO PTC
async function alert_editar_ptc(ptc) {
  //funcao vem do arquivo de update de produto
  var html = monta_inputs_ptc(ptc);
  var title = !ptc ? '<h2>Adicionar mais variedades deste produto</h2>'
    : "<h2>Editar Produto</h2><br><h5>Estoque pode ser alterado somente no menu de Estoques!.</h5>"

  let parser = new DOMParser();
  //ELEMENTO ESTANCIADO DOM VIRA O 'document' NESSE CONTEXTO DO SWAL
  let doc = parser.parseFromString(html, "text/html");

  var ptcId = doc.getElementById('divPai').getAttribute('data-ptcId');

  const { value: formValues } = await Swal.fire({
    title: title,
    html: doc.getElementById('divPai'),
    focusConfirm: true,
    showCancelButton: true,
    stopKeydownPropagation: false,
    cancelButtonText:
      '<h5>Fechar</h5>',
    confirmButtonText: !ptcId ? '<h5>Cadastrar</h5>' : '<h5>Editar</h5>',
    //MANIPULA DADOS DENTRO DO SWAL
    didOpen: (doc) => {
      calcula_lucro(doc)
      $(doc).on('keyup', "input[name='custo']", function () {
        calcula_lucro(doc)
      })
      $(doc).on('keyup', "input[name='preco']", function () {
        calcula_lucro(doc)
      })
    },
    //VALIDA CAMPOS ANTES DA REQUISIÇÃO
    preConfirm: () => {
      if (document.getElementById('custo').value && document.getElementById('preco').value && document.getElementById('estoquePtc').value) {
        return {
          cor_id: document.getElementById('cores').value,
          tamanho_id: document.getElementById('tamanhos').value,
          custo: document.getElementById('custo').value,
          preco: document.getElementById('preco').value,
          quantidade: document.getElementById('estoquePtc').value
        }
      }
      switch (!document.getElementById('custo').value || !document.getElementById('preco').value || !document.getElementById('estoquePtc').value) {
        case !document.getElementById('custo').value:
          Swal.showValidationMessage('Campo custo é obrigatório')
          break;
        case !document.getElementById('preco').value:
          Swal.showValidationMessage('Campo preco é obrigatório')
          break;
        case !document.getElementById('estoquePtc').value:
          Swal.showValidationMessage('Campo estoque é obrigatório')
          break;
        default:
          Swal.showValidationMessage('Todos os campos são obrigatórios')
          break;
      }
    }
  })
  //recebe values dos inputs
  if (formValues) {
    var id = document.getElementById('formUpdateProduto').getAttribute('data-produtoId');
    //  var ptcId = document.getElementById('divPai').getAttribute('data-ptcId');
    if (!ptcId) {
      post_produto_ptc(id, formValues)
    } else {
      update_ptc_produto(id, ptcId, formValues)
    }

  }
}

function confirmando_alteracao(id, funcao) {
  Swal.fire({
    title: '<h1>Digite sua senha</h1><h5>Informe a senha para confirmar a alteração.</h5>',
    html: '<input id="inputSenha" name="password" class="form-control mx-auto w-50" type="password" />',
    inputAttributes: {
      autocapitalize: 'off'
    },
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar',
    showLoaderOnConfirm: true,
    preConfirm: () => {
      const senha = Swal.getPopup().querySelector('#inputSenha').value
      if (!senha) {
        Swal.showValidationMessage(
          'Senha não informada!'
        )
      } else {
        return { senha: senha }
      }
    },
    allowOutsideClick: () => !Swal.isLoading(),
    backdrop: true
  }).then((result) => {
    if (result.isConfirmed) {
      funcao(id, result.value.senha)
    }
  })
}
function verificaStorage() {
  var ptcProduto = local
}

