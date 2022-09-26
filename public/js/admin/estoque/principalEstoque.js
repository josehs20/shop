
function monta_lista_estoque(produtos, collunaFiltro) {
    var produtos = produtos;
    var coluna = collunaFiltro && produtos.length ? `<th scope="col">${collunaFiltro.replace('_id', '')}</th>` : '';
    
    //MONTA CABEÇALHO
    var tabelaEstoque = `<table class="table table-hover"><thead><tr><th scope="col">#</th><th scope="col">Nome</th><th scope="col">Estoques</th>${coluna}</tr></thead><tbody id="tbodyTabelaEstoque"></tbody></table>`
    var divTabelaEstoque = document.getElementById('divTabelaEstoque');
    divTabelaEstoque.innerHTML = tabelaEstoque;
    //DEPOIS DE MONTADA RECEBE TBODY DA TABELA PARA LISTAR OS PRODUTOS
    var tbodyTabelaEstoque = divTabelaEstoque.querySelector('#tbodyTabelaEstoque');
    var listEstoque = '';
    var count = 1;

    produtos.forEach(element => {
        // <td><a href="/produto/${element.id}/edit"><i class="fa fa-edit"></i></a></td>
        listEstoque += `<tr data-bs-toggle="collapse" href="#prod${element.id}"
     role="button" aria-expanded="false" aria-controls="prod" onclick="rotacionarElemento('iconProd${element.id}')">
     <td class="col-1">${count}</td>
     <td>${element.nome}</td>
     <td>${element.totalEstoque}</td>
    
     <td><i id="iconProd${element.id}" class="fa fa-long-arrow-alt-down"></i></td>
     </tr>`
    });

    tbodyTabelaEstoque.innerHTML = listEstoque;
}

function set_tam_cor_cat_storage(params) {
    Object.keys(params).map((key) => {
        localStorage.setItem(key, JSON.stringify(params[key]))
    })
}

function modal_get_itens_filtro(filtro) {
    var elementos = null;
    if (Object.keys(localStorage).includes(filtro)) {
        elementos = JSON.parse(localStorage.getItem(filtro));
        modal_filter_checkbox(elementos, filtro);
    }
}

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
    var data = { coluna: coluna, ids: values }
    $.ajax({
        url: '/get_produtos_filtro/',
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        success: function (resp) {
            monta_lista_estoque(computa_produtos(resp), coluna)
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}
