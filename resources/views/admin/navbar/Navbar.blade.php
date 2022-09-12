<style>
    nav{
        background-color: #FFF;
        padding: 17px 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 5px #ccc !important;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center
    }
    .bmenu{
        visibility: hidden;
    }

    @media(max-width: 860px){
        .bmenu{
            visibility: visible
        }
    }
</style>

<nav>
    <i id="bmenu" class="fa fa-bars bmenu"></i>
    <div class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
</nav>