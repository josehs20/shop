function list_itens_carrinho_finalizar_venda(dados, ptcProduto) {
    var divPai = document.getElementById('carViewFinalizaPedido')
    var itens = ''
    dados.forEach(produto => {
        Object.keys(produto).map((id) => {

            var imagem = produto[id][0].imagens.filter((e) => { return e.prioridade == 1 })[0].nome;

            produto[id].forEach(item => {
                var quantidade = ptcProduto.filter((element) => { return element.produto_id == item.produto_id && item.tamanho_id == element.tamanho_id && item.cor_id == element.cor_id })[0].quantidade;
                itens += `<div class="d-flex card-body" id="carViewFinalizaPedido${item.id}">
                <div class="d-flex card-body">
                <div class="card mb-3 col-8" style="max-height: 150x;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="${'/storage/' + imagem}" class="img-fluid rounded-start" alt="..."
                                style="height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h6 >Nome: &emsp;</h6>
                                    <h5> ${item.produto.nome} </h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <h6>Tamanho: &emsp;</h6>
                                    <h5> ${item.tamanho.nome} </h5>
                                </div>
                                <div class="d-flex align-items-center">
                                <h6 id="carrinhoCorProduto">Cor: &emsp;</h6>
                                <div
                                    style='border-radius: 27px; width: 20px; height: 20px; background-color:${item.cor.codigo}; border: 1px solid black'>
                                </div>
                                    </div>
                                <div class="d-flex align-items-center">
                                    <h6>Preço: &emsp;</h6>
                                    <h5> ${formata_dinheiro(item.preco)} </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 mx-2 col-4" style="max-height: 150x;">
                    <div class="d-flex align-items-center mt-3 mx-2">
                        <h5>Valor: &emsp;</h5>
                        <h4 id="carrinhoValorProduto"> ${formata_dinheiro(quantidade * item.preco)} </h4>
                    </div>
                    <div class="d-flex align-items-center mt-3 mx-2">
                        <h5>Quantidade: &emsp;</h5>

                        <div class="input-group mb-3 mx-2">
                            <button class="btn btn-outline-secondary" type="button" onclick='adiciona_diminui_quantidade_carrinho("+", "carrinhoQuantidadeProduto${item.id}", carViewFinalizaPedido${item.id}, ${JSON.stringify(item)})'>+</button>
                            
                            <input id="carrinhoQuantidadeProduto${item.id}" class="col-3" readonly type="text" value="${quantidade}" class="form-control" placeholder=""
                                aria-label="Example text with two button addons">
                                <button class="btn btn-outline-secondary" type="button" onclick='adiciona_diminui_quantidade_carrinho("-", "carrinhoQuantidadeProduto${item.id}", carViewFinalizaPedido${item.id}, ${JSON.stringify(item)})'>-</button>
                        </div>
                    </div>
                </div>
            </div>
            </div> `

            })
        })
    })
    divPai.innerHTML = itens;
}

function adiciona_diminui_quantidade_carrinho(operador, id, idCard, item) {
    var element = document.getElementById(id);
    var ptcProduto = JSON.parse(localStorage.getItem('ptcProduto'));
    var idCard = idCard;

    if (operador == '+') {
        element.value = parseInt(element.value) + 1
        for (let i = 0; i < ptcProduto.length; i++) {
            const ptc = ptcProduto[i];
            if (ptc.produto_id == item.produto_id && ptc.cor_id == item.cor_id && ptc.tamanho_id == item.tamanho_id) {
                ptcProduto[i].quantidade = element.value
            }

        }
        localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto))
    } else if (operador == '-') {
        if (parseInt(element.value) == 0) {
            //retorna para não ficar com valor negativo
            return
        }
        element.value = parseInt(element.value) - 1
        for (let i = 0; i < ptcProduto.length; i++) {
            const ptc = ptcProduto[i];
            if (ptc.produto_id == item.produto_id && ptc.cor_id == item.cor_id && ptc.tamanho_id == item.tamanho_id) {
                ptcProduto[i].quantidade = element.value
            }
        }
        localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto))
    }
    if (parseInt(element.value) == 0) {

        Swal.fire({
            title: 'Seu item esta com a quantidade 0, deseja excluir?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Sim',
            denyButtonText: `Não`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                for (let i = 0; i < ptcProduto.length; i++) {
                    const ptc = ptcProduto[i];
                    if (ptc.produto_id == item.produto_id && ptc.cor_id == item.cor_id && ptc.tamanho_id == item.tamanho_id) {
                        ptcProduto.splice(i, 1)
                        idCard.remove()
                    }

                }
                localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto))
            } else if (result.isDenied) {
                element.value = 1
            }
        })
    }
}
