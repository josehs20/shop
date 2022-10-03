<style>
    /* nb = navbar */
    .nb {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        margin-top: 7px
    }

    .itens-menu {
        list-style: none;
        display: flex;
        margin: 0 !important;
        padding: 0 !important
    }

    .itens-menu li {
        margin: 0 10px;
    }

    .carrinho {
        position: relative;
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
    }

    .mobile-itens {
        position: fixed;
        bottom: 60px;
        left: 0;
        border: 1px solid #CCC;
        width: 90%;
        transform: translateX(110%);
        transition: 1s;
        list-style: none;        
        margin: 0 20px !important;
        padding: 10px 20px !important;
        
    }

    .mostrar{
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
    }
</style>

<nav class="nb">
    <div>
        <h1 style="margin-bottom: 0 !important">EMPRESA</h1>
    </div>

    <!-- PARA WEB -->
    <ul class="itens-menu">
        <li><a href="/home">Ínicio</a></li>
        <li>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categorias
                </a>
              
                <ul class="dropdown-menu">
                    @foreach ($categorias as $categoria)
                        <li><a class="dropdown-item" href="#">{{$categoria->nome}}</a></li>
                    @endforeach
                </ul>
              </div>
        </li>
        <li><a href="">Contato</a></li>
    </ul>
    <!-- PARA MOBILE -->
    <ul id="mobile-itens" class="mobile-itens">
        <li><a href="/home">Ínicio</a></li>
        <li><a href="">Sobre</a></li>
        <li><a href="">Contato</a></li>
    </ul>
    <div class="mobile-btn-menu">
        <i id="btnMenu" class="fa fa-bars"></i>
        
    </div>


    <!-- DIV DO CANTO DIREITO ONDE FICA OS ICONES -->
    <div class="d-flex">
        <!-- DIV COM ICONE DE CARRINHO PARA PODER MOSTRAR A QUANTIDADE JUNTO -->
        <div class="carrinho">
            <i class="fa fa-shopping-cart"></i>
            <span class="quantidade">0</span>
        </div>
        <!-- SE O USUARIO TIVER LOGADO MOSTRA O NOME DELE -->
        @if (auth()->user())
        
            <div class="nav-item dropdown mx-2">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown">
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
</nav>
<hr>

<script>
    // m = mobile
    var mButton = document.getElementById('btnMenu')
    var mItens = document.getElementById('mobile-itens')
    mButton.addEventListener('click', () => {
        mItens.classList.toggle('mostrar')
        mButton.classList.toggle('fa-times')
    })
</script>
