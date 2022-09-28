function monta_lista_estoque(produtos, tipoMovimento) {
    var produtos = produtos;

    //SET TIPO DE MOVIMENTO ANTES DE INICIAR A VIEW (BALANCO, MOVIMENTAÇÃO OU ZERAMENTO)
    if (tipoMovimento) {
        localStorage.setItem('tipoMovimento', JSON.stringify(tipoMovimento))
    }
    //MONTA CABEÇALHO
    var tabelaEstoque = `<table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Nome</th><th scope="col">Estoques</th></tr></thead><tbody id="tbodyTabelaEstoque"></tbody></table>`
    var divTabelaEstoque = document.getElementById('divTabelaEstoque');
    divTabelaEstoque.innerHTML = tabelaEstoque;

    //DEPOIS DE MONTADA RECEBE TBODY DA TABELA PARA LISTAR OS PRODUTOS
    var tbodyTabelaEstoque = divTabelaEstoque.querySelector('#tbodyTabelaEstoque');
    var listEstoque = '';
    var count = 1;

    produtos.forEach(element => {
        // <td><a href="/produto/${element.id}/edit"><i class="fa fa-edit"></i></a></td>
        listEstoque += `<tr data-bs-toggle="collapse" href="#prod${element.id}"
     role="button" aria-expanded="false" aria-controls="prod" onclick='modal_alterar_estoque(${JSON.stringify(element)})'>
     <td class="col-1">${count}</td>
     <td>${element.nome}</td>
     <td>${element.totalEstoque}</td>
     </tr>`;
        count++;
    });

    tbodyTabelaEstoque.innerHTML = listEstoque;
}

function set_tam_cor_cat_storage(params) {
    Object.keys(params).map((key) => {
        localStorage.setItem(key, JSON.stringify(params[key]))
    })
}

//-----------PARTE DE FILTROS --------//
function modal_get_itens_filtro(filtro) {
    var elementos = null;

    if (Object.keys(localStorage).includes(filtro)) {
        elementos = JSON.parse(localStorage.getItem(filtro));
        modal_filter_checkbox(elementos, filtro);
    } else if (filtro == 'quantidade') {
        modal_filter_qtd_estoque()
    } else if (filtro == 'nome') {
        get_produtos_filtro(filtro, document.getElementById('inputPesquisarEstoque').value)
    }
}
//MODAL FILTRAR POR QUANTIDADE NO ESTOQUE
async function modal_filter_qtd_estoque() {

    const { value: values } = await Swal.fire({
        title: 'Filtrar por quantidade no estoque',
        html: `<div class="d-flex justify-content-center">
        <select id="selectFiltro" class="form-select form-select-sm mx-1" aria-label=".form-select-sm example">
        <option value=">">Maior ></option>
        <option value="<">Menor <</option>
        <option value="=">Igual =</option>
        </select>
        <input type="number" id="qtdEstoqueFiltro" placeholder="Quantidade" class="form-control">
        </div>`,
        focusConfirm: true,
        confirmButtonText: '<h5>filtrar</h5>',
        showCancelButton: true,
        cancelButtonText:
            '<h5>Fechar</h5>',
        preConfirm: () => {

            var input = document.getElementById('qtdEstoqueFiltro').value;
            var select = document.getElementById('selectFiltro').value;
            if (!input) {
                Swal.showValidationMessage('Input quantidade é obrigatório')
            } else {
                return [input, select];
            }

        }
    })

    if (values.length) {
        //filtro por quantidade no estoque
        get_produtos_filtro('tabelaEstoque', values);

    }
}
//MODAL PARA FILTRAR EM COR E TAMANHO E CATEGORIA
async function modal_filter_checkbox(itens, filtro) {
    var inputs = `<form id="formFiltro" method="GET" class="d-flex justify-content-around">`;
    itens.forEach(element => {
        inputs += `<div class="form-check">
            <input name='${filtro}' class="form-check-input" type="checkbox" value="${element.id}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">${element.nome}</label>
            </div>`
    });
    inputs += '</div>'

    const { value: values } = await Swal.fire({
        title: 'Filtrar por ' + filtro.replace('_id', ''),
        html: inputs,
        focusConfirm: true,
        confirmButtonText: '<h5>filtrar</h5>',
        showCancelButton: true,
        cancelButtonText:
            '<h5>Fechar</h5>',
        preConfirm: () => {
            var inputs = document.querySelectorAll(`input[name="${filtro}"]`);
            var ids = []
            inputs.forEach(element => {
                if (element.checked) {
                    ids.push(element.value)
                }
            });
            return ids;
        }
    })

    if (values.length) {
        //filtro se refere a coluna da tabela ptc no banco
        get_produtos_filtro(filtro, values);
    }
}

function get_produtos_filtro(coluna, values) {

    //VERIFICA QUAL TABELA E COLUNA FAZER A CONSULTA 
    //A COLUNA PODE SE REFERENCIAR A UMA TABELA TABÉM 
    //DEPENDENDO DO TIPO DE CONSULTA ESCOLHIDA NA VIEW
    if (coluna == 'tabelaEstoque') {
        var data = { coluna: 'quantidade', valor: values[0], operador: values[1] };
    } else if (coluna == 'nome') {
        var data = { coluna: coluna, nome: values };
    } else {
        var data = { coluna: coluna, ids: values };
    }

    $.ajax({
        url: '/get_produtos_filtro/',
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        success: function (resp) {
            if (Object.keys(resp).length) {
                monta_lista_estoque(computa_produtos(resp))
            } else {
                div_nao_contem_registro('divTabelaEstoque', 'Nenhum registro encontrado')
            }
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}

//----------------MANIPULAÇÃO DOS CHECKEDS E INPUTS NO SWAL DE ATUALIZACAO------------////
function liberar_inputs(check, Idinput) {
    var checkbox = document.getElementById(check);
    var input = document.getElementById(Idinput);
    var select = document.getElementById('selectMovimento' + Idinput.replace('input', ''))
    var selectMovimentoTodos = document.getElementById('selectMovimentoTodos')

    if (JSON.parse(localStorage.getItem('tipoMovimento')) == 'zeramento') {
        if (checkbox.id == 'checkedTodos') {
            desabilita_todos_inputs_swal()

        } else {
            document.getElementById('checkedTodos').checked = false
        }
        return
    }

    if (checkbox.checked) {
        if (select) {
            select.disabled = false
        }
        if (checkbox.checked && checkbox.id == 'checkedTodos') {
            desabilita_todos_inputs_swal()
            if (selectMovimentoTodos) {
                selectMovimentoTodos.disabled = false
            }
        } else {
            document.getElementById('checkedTodos').checked = false;
            document.getElementById('inputTodos').disabled = true;
            document.getElementById('inputTodos').value = '';
            if (selectMovimentoTodos) {
                selectMovimentoTodos.disabled = true
            }
        }
        input.disabled = false;
    } else {
        if (select) {
            select.disabled = true
        }
        input.disabled = true;
    }
}
function desabilita_todos_inputs_swal() {
    var inputs = document.querySelectorAll('.checkboxInput')
    var checkboxs = document.querySelectorAll('.checkboxs')
    var selectTodos = document.querySelectorAll('.selectTodos')
    if (selectTodos) {
        selectTodos.forEach(element => {
            element.disabled = true;
        });
    }
    inputs.forEach(element => {
        element.disabled = true;
    });
    checkboxs.forEach(element => {
        element.checked = false;
    });
}

//------------MONTAGEM DOS INPUTS NO SWAL----------//
function monta_inputs_balanco(attrs) {
    var inputs = `<div class="input-group mb-3">
    <span class="input-group-text">Alterar todos</span>
    <div class="input-group-text">
      <input id="checkedTodos" onclick='liberar_inputs("checkedTodos", "inputTodos")' class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input">
    </div>
    <input disabled type="number" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="inputTodos" placeholder="Alterar todos os itens" class="form-control checkboxInput" aria-label="Text input with">
  </div>`

    attrs.forEach(element => {
        inputs += `<div class="input-group mb-3">
        <span class="input-group-text">${element.tamanho}</span>
        <span class="input-group-text">${element.cor}</span>
        <div class="input-group-text">
          <input id="checked${element.ptcId}" value="input${element.ptcId}" onclick='liberar_inputs("checked${element.ptcId}", "input${element.ptcId}")' class="form-check-input mt-0 checkboxs" type="checkbox" aria-label="Checkbox for following text input">
        </div>
        <input disabled type="number"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="input${element.ptcId}" placeholder="${element.estoque}" value="${element.estoque}" class="form-control checkboxInput" aria-label="Text input with">
      </div>`
    });
    return inputs;
}
function monta_inputs_movimento(attrs) {
    var inputs = `<div class="input-group mb-3">
    <span class="input-group-text">Alterar todos</span>
    <div class="input-group-text">
      <input id="checkedTodos" onclick='liberar_inputs("checkedTodos", "inputTodos")' class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input">
    </div>
    <select disabled id="selectMovimentoTodos" class="form-select" aria-label=".form-select-sm example">
    <option value="-">Retirar</option>
    <option value="+">Adicionar</option>
    </select>
    <input disabled type="number" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="inputTodos" placeholder="Alterar todos os itens" class="form-control checkboxInput" aria-label="Text input with">
  </div>`

    attrs.forEach(element => {
        inputs += `<div class="input-group mb-3">
        <span class="input-group-text">${element.tamanho}</span>
        <span class="input-group-text">${element.cor}</span>
        <div class="input-group-text">
          <input id="checked${element.ptcId}" value="input${element.ptcId}" onclick='liberar_inputs("checked${element.ptcId}", "input${element.ptcId}")' class="form-check-input mt-0 checkboxs" type="checkbox" aria-label="Checkbox for following text input">
        </div>
        <select disabled id="selectMovimento${element.ptcId}" class="form-select selectTodos" aria-label=".form-select-sm example">
        <option value="-">Retirar</option>
        <option value="+">Adicionar</option>
        </select>
        <input disabled type="number"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="input${element.ptcId}" placeholder="${element.estoque}" value="${element.estoque}" class="form-control checkboxInput" aria-label="Text input with">
      </div>`
    });

    return inputs;
}

function monta_inputs_zeramento(attrs) {
    var inputs = `<div class="input-group mb-3">
    <span class="input-group-text">Alterar todos</span>
    <div class="input-group-text">
      <input id="checkedTodos" onclick='liberar_inputs("checkedTodos", "inputTodos")' class="form-check-input mt-0" type="checkbox" aria-label="Checkbox for following text input">
    </div>
    <input disabled type="number" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="inputTodos" placeholder="Alterar todos os itens" class="form-control checkboxInput" aria-label="Text input with">
  </div>`;
    attrs.forEach(element => {
        inputs += `<div class="input-group mb-3">
        <span class="input-group-text">${element.tamanho}</span>
        <span class="input-group-text">${element.cor}</span>
        <div class="input-group-text">
          <input id="checked${element.ptcId}" value="input${element.ptcId}" onclick='liberar_inputs("checked${element.ptcId}", "input${element.ptcId}")' class="form-check-input mt-0 checkboxs" type="checkbox" aria-label="Checkbox for following text input">
        </div>
        <input disabled type="number"  onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" id="input${element.ptcId}" placeholder="${element.estoque}" value="${element.estoque}" class="form-control checkboxInput" aria-label="Text input with">
      </div>`
    });
    return inputs;
}
//----------PARTE DE ALTERAR ESTOQUE----------//
async function modal_alterar_estoque(element) {
    var tipoMovimento = JSON.parse(localStorage.getItem('tipoMovimento'))
    switch (tipoMovimento) {
        case 'balanco':
            var html = monta_inputs_balanco(element.attrs);
            var titulo = 'Balanço de estoque <br><h4>' + element.nome + '</h4><h6>O balanço altera o valor do estoque com o valor exato que você inserir.</h6>'
            break;
        case 'movimentacao':
            var html = monta_inputs_movimento(element.attrs);
            var titulo = 'Movimentação de estoque <br><h4>' + element.nome + '</h4><h6>O movimento é alterado de acordo com o tipo de movimento e quantidade informado.</h6>'
            break;
        case 'zeramento':
            var html = monta_inputs_zeramento(element.attrs);
            var titulo = 'Zeramento de estoque <br><h4>' + element.nome + '</h4><h6>Zeramento de estoque. Vai zerar o estoque dos itens selecionados.</h6>'
            break;
        default:
            break;
    }

    const { value: formValues } = await Swal.fire({
        title: titulo,
        html: html,
        showCancelButton: true,
        confirmButtonText:
            '<h6>Alterar</h6>',
        cancelButtonText:
            '<h6>Fechar</h6>',
        focusConfirm: true,
        stopKeydownPropagation: false,
        didOpen: () => {
            liberar_inputs(check, input);
        },
        preConfirm: () => {
            var inputs = document.querySelectorAll('.checkboxInput')
            var checkboxs = document.querySelectorAll('.checkboxs')
            var inputTodos = document.querySelector('#inputTodos').value
            var data = []
            if (inputTodos || document.getElementById('checkedTodos').checked) {
                inputs.forEach(input => {
                    if (tipoMovimento == 'balanco') {
                        data.push({ id: input.id.replace('input', ''), quantidade: inputTodos })
                    } else if (tipoMovimento == 'movimentacao') {
                        //ESSE MOVIMENTO DA MOVIMENTACAO É O MOVIMENTO DO SELECT
                        var movimento = document.getElementById('selectMovimentoTodos').value
                        data.push({
                            id: input.id.replace('input', ''),
                            quantidade: inputTodos,
                            tipoMovimento: movimento
                        })
                    } else if (tipoMovimento == 'zeramento') {
                        data.push({
                            id: input.id.replace('input', ''),
                            quantidade: 0,
                        })
                    }
                })
            } else {
                checkboxs.forEach(check => {
                    inputs.forEach(input => {
                        if (check.checked && check.value == input.id && !input.value) {
                            Swal.showValidationMessage('Todos campos marcados, tem qeu ser preenchidos')
                        } else if (check.checked && check.value == input.id && input.value) {
                            if (tipoMovimento == 'balanco') {
                                data.push({ id: input.id.replace('input', ''), quantidade: input.value })
                            } else if (tipoMovimento == 'movimentacao') {
                                var movimento = document.getElementById('selectMovimento' + input.id.replace('input', '')).value
                                data.push({
                                    id: input.id.replace('input', ''),
                                    quantidade: input.value,
                                    tipoMovimento: movimento
                                })
                            } else if (tipoMovimento == 'zeramento') {
                                data.push({
                                    id: input.id.replace('input', ''),
                                    quantidade: 0,
                                })
                            }
                        }
                    });
                });
            }
            return data
        }
    })

    if (formValues) {
        update_estoque(formValues);
    }
}
//----------------REQUISIÇÃO----------//
function update_estoque(data) {
    //REMOVE O ELEMENTO ID TODOS DO ARRAY DE OBJETO
    data = data.filter((item) => item.id != 'Todos');
    console.log(data);
    $.ajax({
        url: '/update-estoques',
        method: 'PUT',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { data },
        dataType: 'json',
        success: function (resp) {
            if (resp.valido) {
                monta_lista_estoque(computa_produtos(resp.dados))
                alerta('success', resp.msg, '', false);
            } else {
                alerta('info', resp.msg, '', false);
            }
        },
        error: function (erros) {
            alerta('error', 'Não foi possível atualizar o estoque tente novamente.', '', false);
        }
    })
}