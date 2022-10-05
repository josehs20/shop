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
        bottom: 55px;
        text-align: center;
        background-color: #CCC;
        letter-spacing: 2px;
        height: 0 !important;
        overflow: hidden;
    }
    .produto{
        position: relative;
    }
    .produto:hover .ver-produto{
        height: fit-content !important;
    }
</style>

<section class="varios-produtos">
    @foreach ($produtos as $produto)    
            <div class="card me-2 mb-3 produto" style="width: 15rem;">
                <div class="ver-produto">Ver produto</div>
                <img src="https://img.elo7.com.br/product/main/2B34062/blusa-de-frio-moletom-personalizada-nike-tamanho-m-blusa-de-frio-moletom-personalizada-nike.jpg"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $produto['nome'] }}</h5>
                    <p class="card-text">
                        @if ($produto['precoMenor'] == $produto['precoMaior'])
                            {{$produto['precoMenor']}}
                        @else
                            {{$produto['precoMenor']}} - 
                            {{$produto['precoMaior']}}
                        @endif
                    </p>
                </div>
            </div>
    @endforeach

</section>