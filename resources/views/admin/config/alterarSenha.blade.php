@extends('layouts.app')

<style>
    .conteudo-alterar-senha {
        padding: 0 20px;
        width: 50%;
        margin: 0 auto !important;
    }
    .larguraInput {
        width: 40% !important;
    }

    @media(max-width: 860px) {
        .larguraInput {
            width: 90% !important;
        }
        .conteudo-alterar-senha {
            width: 100% !important;
        }
    }
</style>

@section('content')
    <main class="conteudo-alterar-senha">
        <div class="card">
            <form id="formularioAlterarSenha" method="PUT">
                @csrf
                <div class="card-header">
                    <h5 style="margin: 0 !important">Alterar senha</h5>
                </div>

                <div class="card-body d-flex flex-column align-items-center">
                    <input id="novaSenha" required type="password" class="form-control mb-2 larguraInput" placeholder="Nova senha">
                    <input id="confirmaNovaSenha" required type="password" class="form-control mb-2 larguraInput" placeholder="Confirme a senha">
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
                    <div>
                        <!-- BOTOES FICAM AQUI -->
                        <button type="submit" onclick="verificar_senhas(<?php echo auth()->user()->id?>, atualizarSenhaUsuario); return false;" class="btn btn-outline-success">Atualizar</button>
                    </div>
                </div>

            </form>
        </div>
    </main>
@endsection
<script src="{{ asset('js/admin/configuracoes/alterarSenha.js') }}" defer></script>