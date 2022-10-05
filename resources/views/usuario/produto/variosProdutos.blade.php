<style>
    .varios-produtos {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        width: 100%;
    }

    .ver-produto{        
        position: absolute;
        width: 100%;
        bottom: 0;
        text-align: center;
        font-weight: bold;
        background-color: #797979;
        letter-spacing: 2px;
        height: 0 !important;
        overflow: hidden;
        transition: 0.5s;
        color: #FFF;
    }
    .produto{
        position: relative;
    }
    .produto:hover .ver-produto{
        padding: 4px;
        height: 30% !important;
    }
</style>

<section class="varios-produtos">
    @foreach ($produtos as $produto)    
            <div class="card me-2 mb-3 produto" style="width: 16rem;">
                <div class="ver-produto">VER PRODUTO</div>
                <img src="https://img.elo7.com.br/product/main/2B34062/blusa-de-frio-moletom-personalizada-nike-tamanho-m-blusa-de-frio-moletom-personalizada-nike.jpg"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-center">{{ $produto['nome'] }}</h5>
                    <p class="card-text d-flex justify-content-center">
                        @if ($produto['precoMenor'] == $produto['precoMaior'])
                            R$ {{$produto['precoMenor']}}
                        @else
                            R$ {{$produto['precoMenor']}} - 
                            R$ {{$produto['precoMaior']}}
                        @endif
                    </p>
                </div>
            </div>
    @endforeach

</section>