<style>
    .varios-produtos{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        width: 100%;
    }
</style>

<section class="varios-produtos">
    @foreach ($produtos as $produto)
    <div class="card me-2 mb-3" style="width: 250px;">
        <img src="https://img.elo7.com.br/product/main/2B34062/blusa-de-frio-moletom-personalizada-nike-tamanho-m-blusa-de-frio-moletom-personalizada-nike.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $produto->nome }}</h5>
            <p class="card-text">
                descrição do produto
            </p>
        </div>
    </div>
@endforeach

</section>