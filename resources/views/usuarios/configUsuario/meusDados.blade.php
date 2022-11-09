@extends('layouts.baseUsuario')

<style>
    .div-filtro {
        display: none !important;
    }

    .btn-filtro {
        display: none !important;
    }

    .conteudo-principal {
        margin-left: 0;
    }

    .conteudo-meus-dados {
        padding: 0 20px;
        width: 50% !important;
        margin: 0 auto !important;
    }

    .larguraInput {
        width: 40% !important;
    }

    @media(max-width: 860px) {
        .larguraInput {
            width: 90% !important;
        }

        .conteudo-meus-dados {
            width: 100% !important;
        }
    }
</style>

@section('conteudo')
    <main class="conteudo-meus-dados">
        <div class="card">
            <form id="formularioMeusDados"
                onsubmit='confirmando_alteracao(<?php echo auth()->user()->id; ?>, atualizarMeusDados); return false;' method="PUT">
                @csrf
                <div class="card-header">
                    <h5 style="margin: 0 !important">Meus dados</h5>
                </div>

                <div class="card-body d-flex flex-column align-items-center">
                    <input id="emailUsuario" name="email" type="search" class="form-control mb-2 larguraInput"
                        value="{{ auth()->user()->email }}" />
                    <input id="nomeUsuario" name="name" type="search" class="form-control mb-2 larguraInput"
                        value="{{ auth()->user()->name }}" />
                    {{-- <input id="" type="search" required class="form-control mb-2 w-25" placeholder="Senha"> --}}
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
                    <div>
                        <!-- BOTOES FICAM AQUI -->
                        <button type="submit" class="btn btn-outline-success">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('js/usuario/configuracoesUsuario/meusDados.js') }}" defer></script>
@endsection
