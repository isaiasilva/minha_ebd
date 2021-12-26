@extends('layouts.template')

@section('cabecalho')
    Atualizar Senha
@endsection

@section('conteudo')
    @include('components.flash-message')
    <form method="post" action="{{route('alterar-senha')}}">
        @csrf
        <div class="container">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Nova Senha</label>
                        <input type="password" name="password" id="password" required min="8" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Confirma Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required min="8" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <button type="submit" class="btn btn-primary mt-3">
                        Alterar
                    </button>
                </div>
            </div>

        </div> <!-- Final do container -->
    </form>
@endsection

