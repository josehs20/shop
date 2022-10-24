<aside class="menus mb-4">
    <div class="list-group">
        <a href="{{ route('meusDadosUsuario', auth()->user()->id) }}"
            class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'meusDados') active @endif"
            aria-current="true">
            Meus dados usuario
        </a>
        <a href="{{route('alterarsenha', auth()->user()->id)}}" class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'alterarSenha') active @endif">Alterar senha</a>
        {{-- <a href="#" class="list-group-item list-group-item-action">A third link item</a> --}}
        {{-- <a href="#" class="list-group-item list-group-item-action">A fourth link item</a> --}}
    </div>
</aside>