@extends('layouts.baseUsuario')
@section('conteudo')
<style>
    .individual-produto {
        display: flex;
        justify-content: space-around;
    }

    .ip-imagens {
        /* border: 1px solid black; */
        height: 95vh;
        width: 59%;

        display: flex;
        justify-content: center;
        align-items: center
    }

    .aimagem {
        width: 60%;
        height: 80%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 20px
    }

    .ip-descricao {
        /* border: 1px solid black; */
        min-height: 95vh;
        width: 39%;
    }

    .item {
        padding: 3px 15px;
        margin-right: 7px;
        border-radius: 10px;
        width: fit-content;
    }

    .marcar {
        border: 1px solid orangered;
    }

    .inputCores {
        border-radius: 30px;
        border: 1px solid black;
        width: 30px;
        height: 30px;
    }

    @media(max-width: 860px) {
        .individual-produto {
            flex-direction: column;
            justify-content: center;
            align-items: center
        }

        .ip-descricao {
            width: 100%;
        }

        .ip-imagens {
            width: 100%;
            height: fit-content;
            margin-bottom: 50px;
        }
    }
</style>

<main class="individual-produto">
    <div class="ip-imagens">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"
            style="width: 400px !important; height: 450px !important;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/' .$produtoIndividual->first()->imagens->where('prioridade', 1)->first()->nome) }}"
                        class="d-block w-100" alt="...">
                </div>

                @foreach ($produtoIndividual->first()->imagens->where('prioridade', '!=', 1) as $img)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $img->nome) }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    {{-- DESCRICAO DO PRODUTO NOME, TAMANHO, COR, QUANTIDADE E PRECO --}}
    <div id="ip-descricao" class="ip-descricao">
        <h2 style="font-weight: bold">{{ $produtoIndividual[0]->produto->nome }}</h2>
        <br>
        {{-- TAMANHO --}}
        <div>
            <div class="d-flex justify-content-around">
            <h5>Tamanhos: &nbsp;&nbsp;</h5>
            <h5>Cores: &nbsp;&nbsp;</h5>
            </div>
            <div class="d-flex">
                <select id="selectTamanhos" name="flexRadioTamanho" onchange="get_ptc_relacao_tamanho_cor(<?php echo $produtoIndividual[0]->produto->id; ?>, this.value, 'tam_cor');" class="form-select" aria-label="Default select example">
                    @foreach ($ctc['tamanho_id'] as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
               
                <select id="selectCores" onchange="get_ptc_relacao_tamanho_cor(<?php echo $produtoIndividual[0]->produto->id; ?>, this.value, '');" name="flexRadioCores" class="form-select mx-2" aria-label="Default select example">
                    @foreach ($ctc['cor_id'] as $item)
                    @if ($item->codigo == '#000000' || $item->nome == 'preto')
                    <option style="background-color: {{ $item->codigo }}; color: white;" value="{{ $item->id }}">
                        {{ $item->nome }}
                    </option>
                    @else
                    <option style="background-color: {{ $item->codigo }}" value="{{ $item->id }}">
                        {{ $item->nome }}
                    </option>
                    @endif
                    
                    @endforeach
                </select>
                {{-- @foreach ($tamanhos as $item)
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" value="{{$item->id}}" name="flexRadioTamanho" id="{{'flexRadioTamanho-'.$item->id}}">
                        <label class="form-check-label" for="{{'flexRadioTamanho'.$item->id}}">
                            <h4 id="{{ 't_' . $item->id }}" class="item" style="margin-left: 2px !important; padding: 0 !important;">
                                {{ $item->nome }}
                            </h4>
                        </label>
                    </div>
                @endforeach --}}
            </div>
            <div class="d-flex col-md-10">
                <h6 class="d-none" id="alertTamanho" style="color: red;">Selecione o tamanho</h6>
            </div>
        </div>
        <br>
        {{-- CORES --}}
        <div>
           
            <div class="d-flex">
             
                {{-- @foreach ($cores as $item)
                    <div class="form-check me-3">
                        <input class="form-check-input" value="{{ $item->id }}" type="radio" name="flexRadioCores"
                            id="{{ 'flexRadioCore-' . $item->id }}">
                        <label class="form-check-label" for="{{ 'flexRadioCores' . $item->id }}">
                            <div
                                style='border-radius: 27px; width: 30px; height: 30px; background-color:{{ $item->codigo }}; border: 1px solid black'>
                            </div>
                            {{-- <input id="{{ 'c_' . $item->id }}" class="ms-3 inputCores" type="color" value="{{ $item->codigo }}" disabled> --}}
                {{-- </label>
                    </div>
                @endforeach  --}}
            </div>
            <div class="d-flex col-md-10">
                <h6 class="d-none" id="alertCor" style="color: red;">Selecione a cor</h6>
            </div>
        </div>
        <br>
        <div class="d-flex align-items-center">
            <h5>Quantidade: &nbsp;&nbsp;</h5>
            <input id="quantidade" type="number" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');"
                class="form-control text-center w-25 ms-3" placeholder="0" aria-label="Quantidade">
            <br>
        </div>
        <div class="d-flex justify-content-center col-md-10">
            <h6 class="d-none" id="alertQuantidade" style="color: red;">Quantidade inválida</h6>
        </div>
        <br>
        <br>
        <div>
            <button onclick="adicionarAoCarrinho(<?php echo $produtoIndividual[0]->produto->id; ?>)" id="buttonCarrinho"
                class="btn btn-outline-success w-75"><i class="fa fa-cart-plus"></i> &nbsp; Adicionar ao
                carrinho</button>
        </div>
    </div>
</main>
@endsection

