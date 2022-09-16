//FUNÇÃO QUE VAI FAZER A EXCLUSÃO
function excluir_elemento(elementoID, rota, funcaoGetElementos) {
    var formData = new FormData()
    formData.append('_method', 'delete')
    axios.post(`${rota}${elementoID}`, formData)
        .then(response => {
            alerta('success', response.data)
            if(funcaoGetElementos == "get_categorias"){
              get_categorias()
            }
            if(funcaoGetElementos == "get_tamanhos"){
              get_tamanhos()
            }
            if(funcaoGetElementos == "get_cores"){
              get_cores()
            }
        }).catch(errors => {
            console.log(errors);
        })
  }