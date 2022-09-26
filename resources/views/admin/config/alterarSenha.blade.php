@extends('layouts.app')

<style>
    .conteudo-alterar-senha {
        padding: 0 20px;
        width: 100%;
    }
</style>

@section('content')
    <main class="conteudo-alterar-senha">
        <div class="card">
            <form onsubmit="" id="formAlterarSenha" method="">
                @csrf
                <div class="card-header">
                    <h5 style="margin: 0 !important">Alterar senha</h5>
                </div>

                <div class="card-body d-flex flex-column align-items-center">
                    <input id="" required type="search" class="form-control mb-2 w-25" placeholder="Nova senha">
                    <input id="" required type="search" class="form-control mb-2 w-25" placeholder="Confirme a senha">
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
@endsection
