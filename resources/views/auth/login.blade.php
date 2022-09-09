@extends('layouts.app')

<style>
    .entrar{
        display: flex;
    }
    .div-imagem{
        width: 60%;
        background-image: url(imagens/montanha.png);
        background-size: cover;
        background-repeat: no-repeat;
        min-height: 100vh;
    }
    .div-form{
        width: 40%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .div-form form{
        width: 300px;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center
    }
    .div-form input{
        width: 100%;
        margin: 7px 0;
    }
    .bcustom{
        width: 100% !important;
        margin-top: 40px
    }
    .tenho-conta{
        margin-top: 10px
    }
    @media(max-width: 860px){
        .entrar{
            justify-content: center;
            align-items: center;
        }
        .div-imagem{
            display: none;
        }
        .div-form{
            width: 100%;
            height: 100vh;
        }
        .div-form form{
            border: 1px solid #ccc !important;
            padding: 50px 20px;
            border-radius: 15px;
            margin: 40px 0
        }
    }
</style>

@section('content')
    <main class="entrar">
        <div class="div-imagem">

        </div>
        <div class="div-form">
            <form method="POST" action="{{ route('login') }}">
                <h1>Entrar</h1>
                @csrf
                <!-- EMAIL -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Nome de usuário" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- SENHA -->
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Senha" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <!-- BOTAO LOGIN -->
                <button type="submit" class="btn btn-outline-primary bcustom">
                    ENTRAR
                </button>

                <a class="tenho-conta" href="{{route('register')}}"> Não tenho conta </a>

                <!-- ESQUECI MINHA SENHA -->
                {{-- @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif --}}

            </form>
        </div>
    </main>
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
