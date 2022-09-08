<style>
    aside {
        background-color: #FFF;
        height: 100%;
        box-shadow: 2px 0px 5px #ccc !important;
        padding: 20px;
    }

    .logo{
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

    .opcoes{
        padding: 4px 10px;
        margin: 0 10px
    }

    .opcoes:hover{
        background-color: #eee;
        padding: 4px 10px;
        border-radius: 10px
    }    

    .active {
        background-color: orangered !important;
        color: #FFF !important;
    }

    .esconder {
        display: none;
    }
</style>

<aside id="aside">
    <h1 class="logo">EMPRESA</h1>
    <br>
    <!-- NOME OU LOGO DA EMPRESA -->
    <div class="dashboard-opcao @if (Request::segment(1) == 'home') active @endif">
        <div>
            <i class="fa fa-home"></i>
            <h5>Dashboard</h5>
        </div>
    </div>

    <!-- CADASTROS -->
    <div>
        <a class="dashboard-opcao" data-bs-toggle="collapse" href="#cadastros" role="button"
            aria-expanded="false" aria-controls="cadastros">
            <div>
                <i class="fa fa-book"></i>
                <h5>Cadastros</h5>
            </div>
            <i class="fa fa-sort-down mb-2"></i>
        </a>
    </div>
    <div class="collapse" id="cadastros"> 
        <p class="opcoes"><a href="#produtos">- &nbsp;&nbsp;&nbsp; Produtos</a></p>       
    </div>

    <!-- CONFIGURAÇÕES -->
    <div>
        <a class="dashboard-opcao" data-bs-toggle="collapse" href="#config" role="button"
            aria-expanded="false" aria-controls="config">
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

<script src="{{ asset('js/sidebar/sidebar.js') }}" defer></script>
