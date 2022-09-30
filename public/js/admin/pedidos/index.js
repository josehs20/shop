function get_pedidos(data) {
    if (data == 'nome') {
        data = { nome: document.getElementById('inputPesquisarPedido').value }
    }
    $.ajax({
        url: '/get_pedidos',
        method: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,
        dataType: 'json',
        success: function (resp) {
            if (!resp.length) {
                div_nao_contem_registro('divTabelaPedido', 'Nenhum registro encontrado');
                return;
            }
            monta_lista_pedidos(resp);
        },
        error: function (errors) {
            console.log(errors);
        }
    })
}
get_pedidos();

//---------MONTAGEM DA TABELA--------//
function monta_lista_pedidos(pedidos) {
    document.getElementById('divTabelaPedido').innerHTML = `<table class="table table-hover"><thead><tr><th scope="col">Nº</th><th scope="col">Data</th><th scope="col">Valor</th><th scope="col">Status</th><th scope="col"></th></tr></thead><tbody id="tbodyTabelaPedido"></tbody></table>`;
    var tbodyTable = document.getElementById('tbodyTabelaPedido')
    var table = ''

    pedidos.forEach(element => {
        var collapse = ''
        element.pedido_itens.forEach(item => {
            collapse += `<tr>
                <td>${item.ptc.produto.nome}</td>
                <td>${item.ptc.cor.nome}</td>
                <td>${item.ptc.tamanho.nome}</td>
                <td>${item.quantidade}</td>    
                <td>${formata_dinheiro(item.ptc.preco)}</td>              
             </tr>`
        })

        table += `<tr data-bs-toggle="collapse" href="#pedido${element.id}"
        role="button" aria-expanded="false" aria-controls="prod" onclick="rotacionarElemento('iconProd${element.id}')">
        <td class="col-1">${element.numero_pedido}</td>
        <td>${formata_data(new Date(element.data))}</td>
        <td>${formata_dinheiro(element.valor_total)}</td>
        <td class="col-1">${formata_status(element.status)}</td>
        <td><i id="iconProd${element.id}" class="fa fa-long-arrow-alt-down"></i></td>
        </tr>
    <tr>
        <td colspan="5">
            <div class="collapse" id="pedido${element.id}"> 
            <table class="table table-success table-striped">
            <thead>
              <tr>
              <th scope="col">Nome</th>
                <th scope="col">Cor</th>
                <th scope="col">Tamanho</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preco</th>
              </tr>
            </thead>
            <tbody>
            ${collapse}
            <tr>
            <td colspan="4"><h6>Cliente: ${element.users.name}&emsp;/Cidade: ${element.endereco.cidade}</h6></td>
                <td class="d-flex justify-content-between">
                   <p></p>
                    <a href="/pedidos/${element.id}" type="button" class="btn btn-outline-primary">Ir para pedido</a>
                </td>
            </tr>
            </tbody>
            </table> 
            </div>
        </td>
    </tr>
    `
    });

    tbodyTable.innerHTML = table
}
//-------------MODAL CONSULTA--------------//
async function modal_filtro_pedido(filtro) {
    if (filtro == 'datas') {
        var html = inputs_filtro_datas();
    } else if (filtro == 'cidade') {
        var html = inputs_filtro_cidades();
    }

    const { value: formValues } = await Swal.fire({
        title: 'Buscar por ' + filtro,
        html: html,
        focusConfirm: false,
        confirmButtonText: 'Buscar',
        preConfirm: () => {
            var elementos = document.querySelectorAll('.inputFiltroPedido')
            var data = {};
            elementos.forEach(element => {
                if (!element.value) {
                    Swal.showValidationMessage('Necessário preencher todos os campos')
                } else {
                    if (element.type == 'date') {
                        element.name == 'inicial' ? data.inicial = element.value : data.final = element.value
                    } else {
                        data.cidade = element.value
                    }
                }
            });
            return data
        }
    })

    if (formValues) {
        //FAZ A REQUISICAO
        get_pedidos(formValues)
    }
}
//----------------FUNÇÕES QUE MONTAM O HTML DOS FILTROS-----------------//
function inputs_filtro_datas() {
    var html = `<div class="input-group mb-3">
    <span class="input-group-text">Inicial</span>
    <input type="date" name="inicial" class="form-control inputFiltroPedido" placeholder="Username" aria-label="Username">
    <span class="input-group-text">Final</span>
    <input type="date" name="final" class="form-control inputFiltroPedido" placeholder="Server" aria-label="Server">
  </div>`;

    return html
}
function inputs_filtro_cidades() {
    var html = `<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Cidade</span>
    <input type="text" name="cidade" class="form-control inputFiltroPedido" placeholder="Nome da cidade" aria-label="Username" aria-describedby="basic-addon1">
  </div>`;

    return html
}