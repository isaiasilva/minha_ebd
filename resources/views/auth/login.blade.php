@extends('layouts.inicio')

@section('conteudo')

    <form method="post" action="/entrar">
        @csrf
        <div class="container-fluid">
            <div class="row full-height">
                <div class="col-md-6 col-12">
                    <div class="row full-height justify-content-center">
                        <div class="col-12 col-md-8 col-xxl-5 align-self-center">
                            <img src="{{ asset('img/logo_sem_fundo.png') }}" class="img-fluid pt-5" alt="login">
                            @include('components.flash-message')
                            <p class="lead mb-4">Faça o login para continuar</p>
                            <input class="input border-0 border-bottom p-2" placeholder="E-mail" type="email" name="email" required/>
                            <br />
                            <input class="input border-0 border-bottom p-2" placeholder="Senha" type="password" name="password" required />
                            <br />
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary">Logar</button>
                            </div>

                            <hr class="m-5" />
                          </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </form>
@endsection
