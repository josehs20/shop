<aside class="menus">
    <div class="list-group">
        <a href="{{ route('meusdados', auth()->user()->id) }}"
            class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'meusdados') active @endif"
            aria-current="true">
            Meus dados
        </a>
        <a href="{{route('alterarsenha', auth()->user()->id)}}" class="list-group-item list-group-item-action
            @if (Request::segment(2) == 'alterarsenha') active @endif">Alterar senha</a>
        {{-- <a href="#" class="list-group-item list-group-item-action">A third link item</a> --}}
        {{-- <a href="#" class="list-group-item list-group-item-action">A fourth link item</a> --}}
    </div>
</aside>