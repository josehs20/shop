function padroniza_formulario_update() {
    document.getElementById('imagensProduto').remove();
    var InputsPtc = [document.querySelectorAll(".inumero"), document.querySelectorAll("select")];
    InputsPtc.forEach(div => {
        div.forEach(element => {
            var removeRequired = element.querySelector('input')
            if (removeRequired) {
                //necessária pois no submite o DOM tenta validar os inputs
                removeRequired.removeAttribute('required')
            }
            element.classList.add('d-none');
        });
    });
    document.querySelector("select[name='categoria']").classList.remove('d-none');
    document.querySelector("h5[href='#cadastroDeProdutos']").click();
}

padroniza_formulario_update()

async function preenche_campos(dados) {
    /*Para funcao computa_produtos fucionar precisa passar um array
     mesmo contendo 1 objeto ou outro array dentro */
    produto = computa_produtos([dados])[0]

    /*ATENÇÃO 'monta_imagens_update' armazena o caminho das imagens em localStorage do browser
    sempre que imagem for atualizada ou removida essa chave tem qeu ser atualizada */
    monta_imagens_update(produto.imagens);

    monta_lista_update_produto(await produto)

    var nome = document.querySelector("input[name='nome']");
    nome.value = produto.nome;
    var categoria = document.querySelector("select[name='categoria']");
    categoria.value = produto.categoria
    var estoque = document.querySelector("input[name='estoque']");
    estoque.value = produto.totalEstoque;
    estoque.disabled = true;
    estoque.parentNode.setAttribute('title', 'Esse é o total de todo seu estoque deste produto.')
    //append js só monstra texto jquery monta o botao com estilo já
    $(".card-body").first().append('<button type="submit" sty class="btn btn-outline-primary">Atualizar</button>');

    //passa id do produto pela funcao update_produto(), para ser reconhecido do php
    document.getElementById('formUpdateProduto').setAttribute('onsubmit', `update_produto(${produto.id}); return false;`)
    //necessario indicar o id por um data 'html' para assim ser possível passar no parametro de roda para reconheciemnto no php
    document.getElementById('formUpdateProduto').setAttribute('data-produtoId', produto.id)
}

function monta_lista_update_produto(produto) {
    var div = document.querySelector('#tabelaProdutoUpdate');
    div.classList.remove('d-none');

    //tabela ja recebendo cabeçalho
    var tabela = `<table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Tamanho</th><th scope="col">Cor</th><th scope="col">Estoque</th><th scope="col">Custo</th><th scope="col">Preco</th><th scope="col">Editar</th></tr></thead><tbody>`;
    var count = 1

    //ordena em ordem alfabetéica os tamanhos
    produto.attrs.sort((a, b) => {
        return a.tamanho < b.tamanho ? -1 : a.tamanho > b.tamanho ? 1 : 0;
    }).forEach(element => {
        tabela += `<tr style="cursor:pointer;" onclick='alert_editar_ptc(${JSON.stringify(element)})'>
                    <th scope="row">${count}</th>
                    <td>${element.tamanho}</td>
                    <td>${element.cor}</td>
                    <td>${element.estoque}</td>
                    <td>${element.custo}</td>
                    <td>${element.preco}</td>
                    <td><i class="fa fa-edit"></i></td>
                   </tr>`
        count++
    });
    tabela += "</tbody></table>"
    div.innerHTML = tabela
}

function local_storage_dados_banco_ptc(dados) {
    localStorage.setItem('tamanhos', JSON.stringify(dados.tamanhos));
    localStorage.setItem('cores', JSON.stringify(dados.cores));
}

function monta_inputs_ptc(ptc) {
    var cores = JSON.parse(localStorage.getItem('cores')).map(function (e) { return { nome: e.nome, id: e.id } });
    var tamanhos = JSON.parse(localStorage.getItem('tamanhos')).map(function (e) { return { nome: e.nome, id: e.id } });

    var selectCores = '';
    cores.forEach(cor => {
        selectCores += `<option ${ptc && cor.nome == ptc.cor ? 'selected' : ''} value="${cor.id}">${cor.nome}</option>`
    });
    var selectTamanhos = '';
    tamanhos.forEach(tam => {
        selectTamanhos += `<option ${ptc && tam.nome == ptc.tamanho ? 'selected' : ''} value="${tam.id}">${tam.nome}</option>`
    });

    var html = `<div id="divPai" data-ptcId="${ptc ? ptc.ptcId : ''}">
                <div class="row d-flex">
                <div class="input-group mb-3 w-50">
                <span class="input-group-text" for="inputGroupSelect02">Cores</span>
                <select id="cores" class="form-select">${selectCores}</select>
                </div>
                <div class="input-group mb-3 w-50">
                <label class="input-group-text" for="inputGroupSelect02">Tamanhos</label>
                <select id="tamanhos" class="form-select">${selectTamanhos}</select>
                </div>
                </div>
                <div class="row col-md-12">
                <div class="input-group mb-2 w-50 inumero">
                <span class="input-group-text" id="basic-addon1">Custo</span>
                <input id="custo" name="custo" value="${ptc ? ptc.custo : ''}" required onkeyup="calcula_lucro(), mascaraDinheiro('inputCusto')" type="text" class="form-control inputCusto" placeholder="Custo">
                </div>
                <div class="input-group mb-2 w-50 inumero">
                <span class="input-group-text" id="basic-addon1">Preco</span>
                <input id="preco" name="preco" value="${ptc ? ptc.preco : ''}" required onkeyup="calcula_lucro(), mascaraDinheiro('inputPreco')" type="text" class="form-control inputPreco" placeholder="Preço">
                </div>
                <div class="input-group mb-2 w-50 inumero">
                <span class="input-group-text" id="basic-addon1">Lucro</span>
                <input name="lucro" readonly type="text" class="form-control col-5" placeholder="Lucro">
                </div>
                <div class="input-group mb-2 w-50 inumero">
                <span class="input-group-text" id="basic-addon1">Estoque</span>
                <input id="estoquePtc" value="${ptc ? ptc.estoque : ''}" ${ptc ? 'readonly' : ''} type="text" class="form-control col-5" placeholder="Estoque" name="estoque">
                </div></div></div>`;
    return html;
}

//--------------UPDATES E CREATE PTC---------------------//

function update_produto(id) {
    var data = {
        nome: document.querySelector('input[name="nome"]').value,
        categoria_id: document.querySelector('select[name="categoria"]').value
    }
    $.ajax({
        url: '/produto/' + id,
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        data: data,
        success: function (response) {
            alerta('success', 'Produto Alterado com sucesso.', '', true)
        },
        error: function (errors) {
            var erro = errors.responseJSON.message.split(':');
            if (erro[0] == 'SQLSTATE[23000]') {
                alerta('error', 'Produto com esse nome já existe', '', true)
            } else {
                console.log(errors);
            }

        }
    });
}

function update_ptc_produto(id, ptcId, data) {
    data.ptcId = ptcId,
        $.ajax({
            url: '/update_ptc/' + id,
            method: 'PUT',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            dataType: 'json',
            data: data,
            success: function (response) {
                monta_lista_update_produto(computa_produtos([response.produto])[0])
                alerta('success', response.msg, '', true)
            },
            error: function (errors) {
                if (errors.status == 422) {
                    alerta('error', JSON.parse(errors.responseText).msg, '', false);
                } else {
                    alerta('error', 'Algo deu errado', 'Atualize a página e tente novamente', false);
                }
            }
        });
}

function post_produto_ptc(id, data) {
    $.ajax({
        url: '/store_ptc/' + id,
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        success: function (response) {
            monta_lista_update_produto(computa_produtos([response.produto])[0])
            alerta('success', response.msg, '', true)
        },
        error: function (errors) {
            if (errors.status == 422) {
                alerta('error', JSON.parse(errors.responseText).msg, '', false);
            } else {
                alerta('error', 'Algo deu errado', 'Atualize a página e tente novamente', false);
            }
        }
    })
}
//--------------------IMAGENS------------------------//
function monta_imagens_update(imagens) {
    localStorage.setItem('imagensProduto', JSON.stringify(imagens));

    var caminhos = JSON.parse(localStorage.getItem('imagensProduto'));
    var divImagens = document.getElementById('divListaImagensProdutos');
    cardsImg = '';
    caminhos.forEach(img => {
        cardsImg += `<div style="cursor:pointer;" onclick='' class="col-md-2">
               <div id="card${img.id}" class="card h-100 ${img.prioridade ? 'order border-success' : ''}">
                <img onclick='prioridade_imagem(${img.id})' src="/storage/${img.nome}" class="card-img-top" alt="...">
                <div class="card-footer text-muted">
                <a onclick='confirmar_exclusao(${img.id}, "/remove-imagem/", "monta_imagens_update", "Deseja realmente excluir essa imagem?")' class="btn"><i class="fa fa-trash"></i></a>
                </div>
               </div>
            </div>`
    });
   
    divImagens.innerHTML = cardsImg;
}

async function adicionar_imagem(id) {
    var imagens = JSON.parse(localStorage.getItem('imagensProduto'));
    if (imagens.length >= 5) {
        alerta('info', 'Número de imagens atingido, para adicionar outra imagem diferente, exclua alguma atual.')
    } else {
        const { value: files } = await Swal.fire({
            title: 'Selecione',
            input: 'file',
            inputAttributes: {
                'accept': 'image/*',
                'multiple': 'multiple',
            }
        })
        var coutImg = imagens.length + files.length;
        if (coutImg > 5) {
            alerta('info', 'Quantidade atual de imagens, ' + imagens.length + '. São permitidas 5 por produto. Caso queira trocar, apague alguma atual', '', true)
            return;
        }
        if (files) {
            upload_imagem(id, files)
        }
    }
}

function upload_imagem(id, data) {
    const formData = new FormData();

    Object.keys(data).map((key) => {
        formData.append('imagens[]', data[key]);
    })

    $.ajax({
        url: '/upload-imagem-produto/' + id,
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        contentType: false,
        processData: false,
        data: formData,
        dataType: 'json',
        success: function (response) {
            monta_imagens_update(response.imagens);
            alerta('success', response.msg, '', false);
        },
        error: function (errors) {
            alerta('error', 'Algo deu errado', 'Atualize a página e tente novamente', false);
        }
    })
}

function prioridade_imagem(id) {
    $.ajax({
        url: '/prioridade-imagem/' + id,
        method: 'PUT',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        dataType: 'json',
        success: function (response) {
            monta_imagens_update(response.imagens);
            alerta_simples(response.msg)
            //alerta('success', response.msg, '', false);
        },
        error: function (errors) {
            alerta('error', 'Algo deu errado', 'Atualize a página e tente novamente', false);
        }
    })
}


