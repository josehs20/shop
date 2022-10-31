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

    .meus-enderecos {
        width: 70% !important
    }

    .config-enderecos {
        padding: 0 17px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .select-endereco {
        width: 30% !important;
    }

    .numero-bairro-cep{
        width: 100%;
        display: flex;
        height: fit-content;
    }
    .numero-bairro{
        display: flex;
        width: 100%
    }
    .numero-bairro-cep > input{
        height: fit-content;
    }
    .numero{
        width: 120px !important
    }
    .bairro{
        width: 100% !important
    }
    .cep{
        width: 140px !important
    }

    @media(max-width: 860px) {
        .numero-bairro-cep{
            flex-wrap: wrap
        }
        .numero{
            width: 80px !important;
        }
        .cep{
            width: 100% !important;
        }
        .meus-enderecos {
            width: 100% !important;
        }

        .config-enderecos {
            padding: 0 17px;
            flex-direction: column
        }

        .select-endereco {
            width: 100% !important;
            margin-bottom: 20px
        }

        .endereco-tipo {
            margin-bottom: 15px !important
        }
    }
</style>

@section('conteudo')
    <main class="d-flex justify-content-center w-100">
        <div class="card meus-enderecos">
            <form id="" onsubmit='' method="PUT">
                @csrf
                <div class="card-header">
                    <h5 style="margin: 0 !important">Endereços</h5>
                </div>

                <br>

                <div class="config-enderecos">
                    <select class="form-select select-endereco" aria-label="Default select example">
                        <option value="1" selected>Endereço 1</option>
                        <option value="2">Endereço 2</option>
                    </select>
                    <div class="form-check endereco-tipo">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Endereço de entrega
                        </label>
                    </div>
                    <div class="form-check endereco-tipo">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Endereço de cobrança
                        </label>
                    </div>
                </div>

                <br>

                <div class="card-body d-flex flex-column align-items-center">
                    <input id="" name="rua" type="search" class="form-control mb-2 larguraInput"
                        placeholder="Rua front end" value="" />
                    <div class="numero-bairro-cep">
                        <div class="numero-bairro">
                            <input id="" name="numero" type="search" class="form-control mb-2 larguraInput numero"
                                placeholder="137" value="" />
                            <input id="" name="bairro" type="search" class="form-control mb-2 mx-2 larguraInput bairro"
                                placeholder="Centro" value="" />
                        </div>
                        <input id="" name="cep" type="search" class="form-control mb-2 larguraInput cep"
                                placeholder="28300-000" value="" />
                    </div>
                    <div class="d-flex w-100">
                        <input id="" name="cidade" type="search" class="form-control mb-2 me-2 larguraInput w-75"
                            placeholder="Itaperuna" value="" />
                        <input id="" name="UF" type="search" class="form-control mb-2 larguraInput w-25"
                            placeholder="RJ" value="" />
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <p></p> <!-- APENAS PARA OCUPAR ESPAÇO -->
                    <div>
                        <!-- BOTOES FICAM AQUI -->
                        <button type="submit" class="btn btn-outline-success">Adicionar</button>
                        <button type="submit" class="btn btn-outline-warning">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="{{ asset('js/usuario/configuracoesUsuario/meusDados.js') }}" defer></script>
@endsection
