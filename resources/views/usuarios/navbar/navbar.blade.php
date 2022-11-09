<style>
    .logo {
        padding: 20px 0;
    }

    /* nb = navbar */
    .nb {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        margin-top: 7px
    }

    .nb-items {
        position: relative;
        margin-top: 10px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .div-items-menu{
        display: flex;
        justify-content: center;
        width: 100%;
        background-color: #797979
    }

    .itens-menu {
        list-style: none;
        display: flex;
        margin: 10px !important;
        padding: 0 !important;
    }

    .itens-menu li {
        letter-spacing: 2px;
        margin: 0 15px;
    }

    .itens-menu li a{
        color: #FFF !important;
    }

    .dm .dropdown-item{
        color: #000 !important;
    }

    .search-nav {
        width: 50%;
        position: absolute;
        left: 25%;
    }

    .carrinho {
        position: relative;
        height: fit-content;
    }

    .quantidade {
        position: absolute;
        bottom: -10px !important;
        right: 20px;
        background-color: orangered;
        height: fit-content;
        width: fit-content;
        padding: 0 3px;
        border-radius: 10px;
        color: #FFF;
    }

    .mobile-btn-menu {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1001;
    }

    .mobile-itens {
        position: fixed;
        z-index: 1000;
        bottom: 60px;
        left: 0;
        border: 1px solid #FFF;
        width: 90%;
        transform: translateX(110%);
        transition: 1s;
        list-style: none;
        margin: 0 20px !important;
        padding: 10px 20px !important;
        background-color: #FFF;
    }

    .mostrar {
        transform: translateX(0%);
    }

    @media(max-width: 860px) {
        .itens-menu {
            display: none
        }

        .mobile-btn-menu {
            display: block;
            position: fixed;
        }

        .search-nav {
            width: 100%;
            position: absolute;
            top: 45px;
            left: 0;
        }

        .nb {
            margin-bottom: 57px
        }
    }
</style>

<nav class="nb">
    <div class="logo">
        <h1 style="margin-bottom: 0 !important">EMPRESA</h1>
    </div>

    <div class="nb-items">

        <!-- REDE SOCIAIS -->
        <div class="d-flex">
            <i class="fab fa-instagram"></i>
            <i class="fab fa-facebook-square"></i>
        </div>

        <!-- BARRA DE PESQUISA -->
        <form class="d-flex search-nav" role="search">
            <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success px-1" type="submit"><i class="fa fa-search"></i></button>
        </form>

        <!-- DIV DO CANTO DIREITO ONDE FICA OS ICONES -->
        <div class="d-flex">
            <!-- DIV COM ICONE DE CARRINHO PARA PODER MOSTRAR A QUANTIDADE JUNTO -->
            <a style="cursor: pointer;" onclick="abrirFecharCarrinho()">
                <div class="carrinho">
                    <i class="fa fa-shopping-cart"></i>
                    <span id="quantidadeCarrinho" class="quantidade">0</span>
                </div>
            </a>
            <!-- SE O USUARIO TIVER LOGADO MOSTRA O NOME DELE -->
            @if (auth()->user())
                <div class="nav-item dropdown mx-2">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('meusDadosUsuario', auth()->user()->id)}}">
                            Minha conta
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            Sair
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <!-- SE O USUARIO -- NAO -- TIVER LOGADO MOSTRA O ICONE PARA ELE PODER LOGAR OU REGISTRAR -->
                <a href="{{ route('login') }}"><i class="fa fa-user-circle"></i></a>
            @endif
        </div>
    </div>

    <!-- MENU PARA WEB -->
    <div class="div-items-menu">
        <ul class="itens-menu">
            <li><a href="/">Ínicio</a></li>
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorias
                    </a>
                    
                    <ul class="dropdown-menu dm">
                        @foreach ($ctc['categoria_id'] as $categoria)
                            <li><a class="dropdown-item" href="#">{{ $categoria->nome }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li><a href="">Contato</a></li>
        </ul>
    </div>

    <!-- MENU PARA MOBILE -->
    <ul id="mobile-itens" class="mobile-itens">
        <li><a href="/">Ínicio</a></li>
        <li>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Categorias
                </a>

                <ul class="dropdown-menu">
                    @foreach ($ctc['categoria_id'] as $categoria)
                        <li><a class="dropdown-item" href="#">{{ $categoria->nome }}</a></li>
                    @endforeach
                </ul>
            </div>
        </li>
        <li><a href="">Contato</a></li>
    </ul>
    <div class="mobile-btn-menu">
        <i id="btnMenu" class="fa fa-bars"></i>
    </div>

</nav>
<br>

<script>
    // m = mobile
    var mButton = document.getElementById('btnMenu')
    var mItens = document.getElementById('mobile-itens')
    mButton.addEventListener('click', () => {
        mItens.classList.toggle('mostrar')
        mButton.classList.toggle('fa-times')
    })
</script>
