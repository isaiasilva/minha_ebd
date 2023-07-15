@extends('layouts.inicio')

@section('conteudo')
    <style>
        .message-error {
            color: red;
            font-weight: 500;
        }
    </style>


    <div class="row justify-content-center pt-5">

        <div class="col-xl-5 col-lg-5 col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="col-lg pb-4">
                        <div class="p-2 pb-3 ">
                            <div class="text-center pb-4">
                                <img src="{{ asset('img/logo_ebd.png') }}" class="img-fluid pt-5" alt="login">
                            </div>
                            <form class="user" method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control form-control-user"
                                        id="email" placeholder="Insira o seu email." value="{{ old('email') }}">
                                    @error('email')
                                        <small class="message-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        id="password" placeholder="Senha">
                                    @error('password')
                                        <small class="message-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>

                            </form>

                            {{--  <div class="text-center">
                                <a class="small" href="forgot-password.html">Esqueceu a senha?</a>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
