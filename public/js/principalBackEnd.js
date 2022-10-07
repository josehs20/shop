//FUNÇÃO QUE VAI FAZER A EXCLUSÃO
function excluir_elemento(elementoID, rota, funcaoGetElementos) {
  var formData = new FormData()
  formData.append('_method', 'delete')
  axios.post(`${rota + elementoID}`, formData)
    .then(response => {
      if (response.data.contemPTC) {
        var html = monta_html_list_group(response.data.contemPTC, 'Produtos');
        var title = response.data.msg
        var texto = response.data.texto
        alerta_contem_produto_vinculado(html, title, texto)
      } else {

        if (funcaoGetElementos == 'monta_imagens_update') {
          monta_imagens_update(response.data.imagens)
          alerta('success', response.data.msg)
        } else {
          funcaoGetElementos()
          alerta('success', response.data)
        }
      }
    }).catch(errors => {
      if (errors.response.status == 422) {
        alerta('error', errors.response.data.msg)
      } else {
        alerta('error', 'não foi possível tente novamente em alguns instantes.')
      }
    })
}

/*FUNÇÃO PARA ORGANIZAR QUERY DE PRODUTOS VINDO DO PHP
NECESSÁRIO SEMPRE RECEBER UM ARRAY DE OBJ
MESMO CONTENDO SÓ UM ELEMENTO PARA QUE FUNCIONE CORRETAMENTE*/
function computa_produtos(data) {
  var produtos = [];
  Object.keys(data).forEach((key) => {
    //declara o objeto a ser preenchido a cada produto
    var elementList = {
      nome: '',
      categoria: '',
      id: '',
      totalEstoque: parseInt(0),
      imagens: [],
      attrs: []
    }
    //preenche dados dos produtos
    elementList.nome = data[key][0].produto.nome
    elementList.categoria = data[key][0].produto.categoria_id
    elementList.id = data[key][0].produto_id
    elementList.imagens = data[key][0].imagens
    //cria um array de objetos com os attrs da prod_tam_cor
    data[key].forEach(element => {
      elementList.attrs.push({
        cor: element.cor.nome,
        tamanho: element.tamanho.nome,
        estoque: element.estoque.quantidade,
        custo: element.custo,
        preco: element.preco,
        ptcId: element.id
      })
      //soma total do estoque do produto
      elementList.totalEstoque += element.estoque.quantidade
    });
    produtos.push(elementList);
  })
  return produtos;
}

function calcula_lucro(doc) {
  var preco = !doc ? document.querySelector('input[name="preco"]').value : doc.querySelector('input[name="preco"]').value
  var custo = !doc ? document.querySelector('input[name="custo"]').value : doc.querySelector('input[name="custo"]').value
  var lucro = !doc ? document.querySelector('input[name="lucro"]') : doc.querySelector('input[name="lucro"]')

  if (preco && custo) {
    preco = parseFloat(preco.replace(/[^\d]+/g, ''));
    custo = parseFloat(custo.replace(/[^\d]+/g, ''));
    var valor = ((preco - custo) / preco) * 100;
    lucro.value = valor.toFixed(2);
  }
}

function formata_data(dado) {
  return dado.toLocaleDateString("pt-BR")
}
function formata_dinheiro(dado) {
  return parseFloat(dado).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}
function formata_status(dado) {
  switch (dado) {
    case 'crr':
      return 'Carrinho'
    case 'agp':
      return 'Aguardando pagamento'

    case 'pgr':
      return 'Pagamento realizado'

    case 'age':
      return 'Aguardando envio'

    case 'acm':
      return 'A caminho'

    case 'etr':
      return 'Entregue'

    default:
      break;
  }
}

function adicionarAoCarrinho(id){

  var ptcProduto = localStorage.getItem('ptcProduto') ?
         JSON.parse(localStorage.getItem('ptcProduto')) : {}
  
  console.log(ptcProduto)

  document.getElementById('ip-descricao').querySelectorAll('input').forEach((e) => {
    if(e.type == 'radio' && e.checked){
      if(e.name == 'flexRadioTamanho'){
        ptcProduto.flexRadioTamanho = e.id
      }
      if(e.name == 'flexRadioCores'){
        ptcProduto.flexRadioCores = e.id
      }
    }
    if(e.type == 'text' && e.id == 'quantidade'){
      ptcProduto.quants = e.value
    }
  })

  localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto));
}