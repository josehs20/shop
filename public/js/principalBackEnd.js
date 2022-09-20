//FUNÇÃO QUE VAI FAZER A EXCLUSÃO
function excluir_elemento(elementoID, rota, funcaoGetElementos) {
  var formData = new FormData()
  formData.append('_method', 'delete')
  axios.post(`${rota}${elementoID}`, formData)
    .then(response => {
      alerta('success', response.data)
      if (funcaoGetElementos == "get_categorias") {
        get_categorias()
      }
      if (funcaoGetElementos == "get_tamanhos") {
        get_tamanhos()
      }
      if (funcaoGetElementos == "get_cores") {
        get_cores()
      }
    }).catch(errors => {
      console.log(errors);
    })
}

//FUNÇÃO PARA ORGANIZAR QUERY DE PRODUTOS VINDO DO PHP
function computa_produtos(data) {
  var produtos = [];
  Object.keys(data).forEach((key) => {
    var elementList = {
      nome: '',
      id : '',
      totalEstoque: parseInt(0),
      imagens: [],
      attrs: []
    }
    elementList.nome = data[key][0].produto.nome
    elementList.id = data[key][0].produto_id
    elementList.imagens = data[key][0].imagens

    data[key].forEach(element => {
      elementList.attrs.push({
        cor: element.cor.nome,
        tamanho: element.tamanho.nome,
        estoque: element.estoque.quantidade
      })
      elementList.totalEstoque += element.estoque.quantidade
    });
    produtos.push(elementList);
  })
  return produtos;
}