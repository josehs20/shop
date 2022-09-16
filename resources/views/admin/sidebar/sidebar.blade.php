<style>
    aside {
        background-color: #FFF;
        height: 100%;
        box-shadow: 2px 0px 5px #ccc !important;
        padding: 20px;
        position: relative
    }

    .logo {
        letter-spacing: 4px;
        text-align: center
    }

    .dashboard-opcao {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-radius: 10px;
        padding: 10px 15px;
        margin-top: 10px;
        cursor: pointer;
    }

    .dashboard-opcao:focus {
        background-color: #eee !important;
    }

    .dashboard-opcao>div {
        display: flex;
        align-items: center;
    }

    .dashboard-opcao:hover {
        background-color: #eee;
    }

    .dashboard-opcao h5 {
        margin-left: 10px;
        margin-bottom: 0 !important;
    }

    .opcoes {
        padding: 4px 10px;
        margin: 7px 10px;
    }

    .opcoes:hover {
        background-color: #eee;
        padding: 4px 10px;
        border-radius: 10px
    }

    .active {
        background-color: orangered !important;
        color: #FFF !important;
        border-radius: 10px
    }

    .active a{
        color: #FFF !important
    }

    .esconder {
        display: none;
    }

    .fecharSidebar {
        display: none !important;
        position: absolute;
        right: 5px;
        top: 10px;
    }

    @media(max-width: 860px) {
        .fecharSidebar {
            display: flex !important;
        }
    }
</style>

<aside id="aside">
    <?php $teste = false ?>
    <i id="fecharSidebar" class="fa fa-times fecharSidebar"></i>
    
    <h1 class="logo">EMPRESA</h1>
    <br>
    <!-- NOME OU LOGO DA EMPRESA -->
    <div class="dashboard-opcao @if (Request::segment(1) == 'homeAdmin') active @endif">
        <div>
            <i class="fa fa-home"></i>
            <h5><a href="{{route('homeAdmin.index')}}">Dashboard</a></h5>
        </div>
    </div>

    <!-- CADASTROS -->
    <div>
        <a class="dashboard-opcao" data-bs-toggle="collapse" href="#cadastros" role="button" aria-expanded="false"
            aria-controls="cadastros">
            <div>
                <i class="fa fa-book"></i>
                <h5>Cadastros</h5>
            </div>
            <i class="fa fa-sort-down mb-2"></i>
        </a>
    </div>
    <div class="collapse @if (Request::segment(1) == 'cadastro') show @endif" id="cadastros">
        <a href="{{route('produto.index')}}"><p class="opcoes @if (Request::segment(2) == 'produto') active @endif">- &nbsp;&nbsp;&nbsp; Produto</p></a>
        <a href="{{route('categoria.index')}}"><p class="opcoes @if (Request::segment(2) == 'categoria') active @endif">- &nbsp;&nbsp;&nbsp; Categoria</p></a>
        <a href="{{route('tamanho.index')}}"><p class="opcoes @if (Request::segment(2) == 'tamanho') active @endif">- &nbsp;&nbsp;&nbsp; Tamanho</p></a>
    </div>

    <!-- CONFIGURAÇÕES -->
    <div>
        <a class="dashboard-opcao" data-bs-toggle="collapse" href="#config" role="button" aria-expanded="false"
            aria-controls="config">
            <div>
                <i class="fa fa-cog"></i>
                <h5>Configurações</h5>
            </div>
            <i class="fa fa-sort-down mb-2"></i>
        </a>
    </div>
    <div class="collapse" id="config">
        <p class="opcoes"><a href="#produtos">- &nbsp;&nbsp;&nbsp; Minha conta</a></p>
    </div>

</aside>
