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
            <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                aria-controls="collapseExample">
                Categorias <i class="fa fa-caret-down"></i>
            </a>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <ul>
                        @foreach ($categorias as $categoria)
                            <li><a href="#">{{ $categoria->nome }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <hr>
        </li>
    </ul>
</aside>
