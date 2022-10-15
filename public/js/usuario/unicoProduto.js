function get_ptc_relacao_tamanho_cor(id, valor, relacao) {
    var data = relacao == 'tam_cor' ? { produto_id: id, tamanho_id: valor } : { produto_id: id, cor_id: valor }
    $.ajax({
        url: '/get-ptc-relacao-tamanho-cor',
        method: 'GET',
        data: data,
        dataType: 'json',
        success: function (resp) {
            var options = ''
            var seleted = 0;
            //verifica qual select deve ser alterado relacao de tamanho para cor ou vice-versa
            if (relacao == 'tam_cor') {
                var select = document.getElementById('selectCores')

                if (resp.length) {

                    resp.forEach(element => {
                        if (select.value == element.cor.id) {
                            seleted = element.cor.id
                        }
                        if (element.cor.codigo == '#000000' || element.cor.nome == 'preto') {
                            options += `<option style="background-color:${element.cor.codigo}; color: white;" value="${element.cor.id}">
                                            ${element.cor.nome}
                                        </option>`
                        } else {
                            options += `<option style="background-color:${element.cor.codigo};" value="${element.cor.id}">
                                            ${element.cor.nome}
                                        </option>`
                        }

                    });
                    select.innerHTML = options
                    select.value = seleted ? seleted : select.value
                }
            } else {
                var select = document.getElementById('selectTamanhos')
                if (resp.length) {

                    resp.forEach(element => {
                        if (select.value == element.tamanho.id) {
                            seleted = element.tamanho.id
                        }
                        options += `<option value="${element.tamanho.id}">
                        ${element.tamanho.nome}
                    </option>`
                    })
                }
                select.innerHTML = options
                select.value = seleted ? seleted : select.value
            }

        },
        error: function (erros) {
            console.log(erros);
        }
    });
}

function adicionarAoCarrinho(id) {
    exibirDadosNoCarrinho()
    //OBTEM OS DADOS DO LOCALSTORAGE CASO TENHA ALGUM, SE NÃO, CRIA UM ARRAY VAZIO
    var ptcProduto = localStorage.getItem('ptcProduto') ?
        JSON.parse(localStorage.getItem('ptcProduto')) : []

    var cor_id = document.querySelector("select[name='flexRadioCores']").value
    var tamanho_id = document.querySelector("select[name='flexRadioTamanho']").value
    var quantidade = document.getElementById('quantidade').value

    var dados = { produto_id: id, cor_id: cor_id, tamanho_id: tamanho_id, quantidade: quantidade };

    if (valida_quantidade(quantidade)) {
        var verificaCarrinho = ptcProduto.filter((e) => { return e.produto_id == dados.produto_id })

        //verifica e cria caso for outro produto
        if (!verificaCarrinho.length) {
            // ADICIONA O OBJETO NO ARRAY, DESSA FORMA NÃO IRÁ SUBSTITUIR OS VALORES QUANDO INSERIR UM NOVO PRODUTO
            ptcProduto.push(dados)
            // ADICIONA O ARRAY NO STORAGE
            localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto));
            get_pedidos_ptc();
            alerta_simples('success', 'Adicionado com sucesso !')
            return
        } else {
            //verifica se existem mesma cor e tamanho
            verificaCarrinho = ptcProduto.filter((element) => { return element.produto_id == dados.produto_id && dados.tamanho_id == element.tamanho_id && dados.cor_id == element.cor_id });

            if (!verificaCarrinho.length) {
                ptcProduto.push(dados)
                localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto));
                get_pedidos_ptc();
                alerta_simples('success', 'Adicionado com sucesso !')

            } else if (verificaCarrinho.length && parseInt(verificaCarrinho[0].quantidade) != parseInt(dados.quantidade)) {
                //mapeia item e atualiza quantidade
                ptcProduto.map((e) => {
                    if (e.produto_id == dados.produto_id && dados.tamanho_id == e.tamanho_id && dados.cor_id == e.cor_id && parseInt(verificaCarrinho[0].quantidade) == parseInt(e.quantidade)) {
                        e.quantidade = dados.quantidade;
                    }
                })
                //insere ptc remapeado
                localStorage.setItem('ptcProduto', JSON.stringify(ptcProduto));
                get_pedidos_ptc();
                alerta_simples('success', 'Atualizado com sucesso !')
            } else if (verificaCarrinho.length && parseInt(verificaCarrinho[0].quantidade) == parseInt(dados.quantidade)) {
                alerta_simples('info', 'Produto da mesma cor, tamanho e quantidade já existente!', 6000)
            }
        }
    }


}
function valida_quantidade(quantidade) {

    if (quantidade == '' || quantidade == 0) {
        document.getElementById('alertQuantidade').classList.remove('d-none')
        return false
    } else {
        document.getElementById('alertQuantidade').classList.add('d-none')
        return true
    }
}