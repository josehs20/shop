<aside class="menus mb-4">
    <div class="list-group">
        <a href="{{ route('meusDadosUsuario', auth()->user()->id) }}"
            class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'meusDados') active @endif"
            aria-current="true">
            Meus dados usuario
        </a>
        <a href="{{route('alterarSenha', auth()->user()->id)}}" class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'alterarsenha') active @endif">Alterar senha</a>
        <a href="{{route('enderecos', auth()->user()->id)}}" class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'enderecos') active @endif">Endereços</a>
        {{-- <a href="#" class="list-group-item list-group-item-action">A fourth link item</a> --}}
    </div>
</aside>