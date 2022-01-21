@extends('layouts.template')

@section('cabecalho')
    Editar Turma
@endsection
@section('conteudo')
    @include('components.flash-message')
    <form method="post">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome_turma" value="{{$turma->nome_turma}}"  id="nome" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary mt-3">
                        Atualizar
                    </button>
                </div>
            </div>
        </div><!-- FIM DO CONTAINER -->
    </form>
@endsection
