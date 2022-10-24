@extends('layouts.baseUsuario')
@section('conteudo')
<style>
    .varios-produtos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        width: 100%;
    }

    .conteudo-principal {
        margin-left: 0;
    }

    .varios-produtos a,h5,p{
        color: #000 !important;
    }

    .ver-produto {
        position: absolute;
        width: 100%;
        bottom: 100px;
        text-align: center;
        background-color: #d4d4d4;
        letter-spacing: 2px;
        height: 0 !important;
        overflow: hidden;
        transition: 0.5s;
        color: #000;
        opacity: .8;
    }

    .produto {
        position: relative;
    }

    .produto:hover .ver-produto {
        padding: 4px;
        height: 20% !important;
    }

    .divider{
        width: 30px;
        height: 1px;
        background-color: #000;
        margin: 5px 0 15px 0
    }
</style>

<section class="varios-produtos">
    @foreach ($produtos as $produto)
        <a href="{{ route('unicoProduto', $produto['idProduto']) }}">
            <div class="card me-2 mb-3 produto" style="width: 16rem;">
                <div class="ver-produto">VER PRODUTO</div>

                @if (count($produto['imagem']))
                    <img class="mx-auto mt-2" style="width: 220px; height: 230px;"
                        src="{{ asset('storage/' . $produto['imagem'][0]->nome) }}" class="card-img-top"
                        alt="Imagem do produto">
                @endif
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center" style="margin-bottom: 0 !important">{{ $produto['nome'] }}</h5>
                    <div class="divider mx-auto"></div>
                    <p class="card-text d-flex justify-content-center">
                        @if ($produto['precoMenor'] == $produto['precoMaior'])
                            R$ {{ $produto['precoMenor'] }}
                        @else
                            R$ {{ $produto['precoMenor'] }} -
                            R$ {{ $produto['precoMaior'] }}
                        @endif
                    </p>
                </div>
            </div>
        </a>
    @endforeach
</section>
@endsection
