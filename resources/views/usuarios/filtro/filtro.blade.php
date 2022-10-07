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
        padding: 0 10px;
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
        <li>
            <a data-bs-toggle="collapse" href="#collapseCategoria" role="button" aria-expanded="false"
                aria-controls="collapseCategoria">
                Categorias <i id="iconeCategoria" class="fa fa-minus"></i>
            </a>
            <div class="collapse show" id="collapseCategoria">
                <ul>
                    @foreach ($categorias as $categoria)
                        <li><a href="#">{{ $categoria->nome }}</a></li>
                    @endforeach
                </ul>
            </div>
            <hr>
        </li>
    </ul>
</aside>

<script>
    function alterarIcone(idicone, iddiv) {
        var i = document.getElementById(idicone)
        var cat = document.getElementById(iddiv)

        if (i.classList.contains("fa-minus")) {
            i.classList.remove('fa-minus')
            i.classList.add('fa-plus')
            cat.style.display = "none"
        } else {
            i.classList.remove('fa-plus')
            i.classList.add('fa-minus')
            cat.style.display = "flex"
        }
    }
</script>
