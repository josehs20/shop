<style>
    .filtro {
        width: 200px;
        min-height: 80vh;
    }

    .filtro ul {
        list-style: none;
        padding: 0;
        width: 100% !important
    }

    .filtro>ul>li>a {
        display: flex;
        justify-content: space-between;

        width: 100% !important;
    }

    /* @media(max-width: 860px) {
        .filtro {
            display: none;
        }
    } */
</style>

<aside class="filtro">
    <h3>Filtros</h3>
    <hr style="border-color: #000 !important; background: #000; height: 2px">
    <ul>
        {{-- CATEGORIAS --}}
        <li>
            <a data-bs-toggle="collapse" href="#collapseCategoria" role="button" aria-expanded="false"
                aria-controls="collapseCategoria" onclick="alterarIcone('iconeCategoria')">
                <h5>Categorias</h5>
                <i id="iconeCategoria" class="fa fa-minus"></i>
            </a>
            <div class="collapse show" id="collapseCategoria">
                <ul style="margin-top: 5px">
                    @foreach ($ctc['categoria_id'] as $categoria)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $categoria->nome }}
                            </label>
                          </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <hr>
        </li>
        {{-- TAMANHOS --}}
        <li>
            <a data-bs-toggle="collapse" href="#collapseTamanhos" role="button" aria-expanded="false"
                aria-controls="collapseTamanhos" onclick="alterarIcone('iconeTamanhos')">
                <h5>Tamanhos</h5>
                <i id="iconeTamanhos" class="fa fa-minus"></i>
            </a>
            <div class="collapse" id="collapseTamanhos">
                <ul style="margin-top: 5px">
                    @foreach ($ctc['tamanho_id'] as $tamanho)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $tamanho->nome }}
                            </label>
                          </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <hr>
        </li>
        {{-- CORES --}}
        <li>
            <a data-bs-toggle="collapse" href="#collapseCores" role="button" aria-expanded="false"
                aria-controls="collapseCores" onclick="alterarIcone('iconeCores')">
                <h5>Cores</h5>
                <i id='iconeCores' class="fa fa-minus"></i>
            </a>
            <div class="collapse" id="collapseCores">
                <ul style="margin-top: 5px">
                    @foreach ($ctc['cor_id'] as $cor)
                    <li>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $cor->nome }}
                            </label>
                          </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <hr>
        </li>
    </ul>
</aside>

<script>
    //esta funcionando mas nao altera o icone, nao fa??o ideia porque
    function alterarIcone(idicone) {
        // var btnIcone = document.getElementById(idicone)
        // btnIcone.classList.toggle('fa-plus')
        // console.log('funcionando')
        // console.log(btnIcone.classList)

        var icone = document.getElementById(idicone)

        if (icone.classList.contains('fa-minus')) {
            icone.classList.remove('fa-minus')
            icone.classList.add('fa-plus')
        } else {
            icone.classList.remove('fa-plus')
            icone.classList.add('fa-minus')
        }
    }
</script>
