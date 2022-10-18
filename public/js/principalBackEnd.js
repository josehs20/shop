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

function exibirDadosNoCarrinho() {
  var dados = localStorage.getItem('ptcProduto') ?
    JSON.parse(localStorage.getItem('ptcProduto')) : ''

  // var nome  = document.getElementById('carrinhoNomeProduto')
  // var tamanho  = document.getElementById('carrinhoTamanhoProduto')
  // var cor  = document.getElementById('carrinhoCorProduto')
  // var quantidade  = document.getElementById('carrinhoQuantidadeProduto')




  // dados.forEach( (e) => {
  //   var splitTamanhos = e.tamanho.split('-')
  //   var splitCores = e.cor.split('-')
  //   console.log(splitTamanhos[1]);
  //   console.log(splitCores[1]);
  // })
}

get_pedidos_ptc()

function get_pedidos_ptc() {
  var ptcProduto = localStorage.getItem('ptcProduto') ?
    JSON.parse(localStorage.getItem('ptcProduto')) : []

  if (!ptcProduto.length) {
    div_nao_contem_registro('divPaiCarrinhoItens', 'Nenhum item no carrinho')
    document.getElementById('finalizarPedidoButton').classList.add('d-none')
  } else {
    $.ajax({
      url: '/get-pedidos-ptc',
      method: 'GET',
      data: { ptcProduto },
      dataType: 'json',
      success: function (resp) {
        document.getElementById('finalizarPedidoButton').classList.remove('d-none')
        list_carrinho(resp, ptcProduto)
        var carViewFinalizaPedido = document.getElementById('carViewFinalizaPedido');
        if (carViewFinalizaPedido) {
          list_itens_carrinho_finalizar_venda(resp, ptcProduto)
        }


      },
      error: function (erros) {
        console.log(erros);
      }
    });
  }
}

function list_carrinho(dados, ptcProduto) {
  var divCarrinho = document.getElementById('divPaiCarrinhoItens');
  var itens = '';
  var qtdItens = 0;

  dados.forEach(produto => {
    Object.keys(produto).map((id) => {

      var imagem = produto[id][0].imagens.filter((e) => { return e.prioridade == 1 })[0].nome;

      produto[id].forEach(item => {
        qtdItens++
        var quantidade = ptcProduto.filter((element) => { return element.produto_id == item.produto_id && item.tamanho_id == element.tamanho_id && item.cor_id == element.cor_id })[0].quantidade;

        itens += ` <div class="item-do-carrinho">
        <div class="item-carrinho">
            
            <h3 id="carrinhoNomeProduto">${item.produto.nome}</h3>
          
            <div class="d-flex align-items-center">
                <h6 id="carrinhoTamanhoProduto">Tamanho: &emsp;</h6>
                <h5> ${item.tamanho.nome} </h5>
            </div>
           
            <div class="d-flex align-items-center">
                <h6 id="carrinhoCorProduto">Cor: &emsp;</h6>
                <div
                    style='border-radius: 27px; width: 20px; height: 20px; background-color:${item.cor.codigo}; border: 1px solid black'>
                </div>
            </div>
          
            <div class="d-flex align-items-center">
                <h6 id="carrinhoQuantidadeProduto">Quantidade: &emsp;</h6>
                <h5>${quantidade}</h5>
            </div>
            <div class="d-flex align-items-center">
            <h6 id="carrinhoQuantidadeProduto">Valor: &emsp;</h6>
            <h5>${formata_dinheiro(quantidade * item.preco)}</h5>
        </div>
        </div>
        
        <div class="imagem-do-item d-flex align-items-center">
            <img src="${'/storage/' + imagem}"
                class="d-block" alt="Imagem do produto">
        </div>
    </div>`
      })
    })
  });
  document.getElementById('quantidadeCarrinho').innerHTML = qtdItens;
  divCarrinho.innerHTML = itens;
}
