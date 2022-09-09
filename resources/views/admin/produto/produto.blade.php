@extends('layouts.app')
<style>
    .card-body {
        display: flex;
        flex-wrap: wrap
    }

    .card-body input {
        margin-right: 7px
    }

    .inome {
        width: 55% !important
    }

    .inumero {
        width: 140px !important;
    }

    @media(max-width: 860px) {
        .inome {
            width: 100% !important
        }

        .inumero {
            width: 100% !important;
        }
    }
</style>
@section('content')
    <div class="card">
        <form method="POST" action="{{ route('produto.store') }}">
            @csrf
            <h5 class="card-header">Cadastro de produtos</h5>
            <div class="card-body">
                <input type="text" class="form-control mb-2 inome" placeholder="Nome do produto" name="nome">
                <div class="input-group mb-2 inumero">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
                    <input type="number" class="form-control" placeholder="Custo" name="custo">
                </div>
                <div class="input-group mb-2 inumero">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
                    <input type="number" class="form-control" placeholder="Preço" name="preco">
                </div>
                <div class="input-group mb-2 inumero">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-money-bill-wave"></i></span>
                    <input type="number" class="form-control" placeholder="Lucro" name="lucro">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary">Cadastrar</button>
            </div>
        </form>
    </div>
@endsection
