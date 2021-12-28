@extends('layouts.template')

@section('cabecalho')
    Associar Aluno
@endsection
@section('conteudo')
    @include('components.flash-message')
    <form method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="aluno">Professor</label>
                        <select class="form-control" name="aluno" aria-label="Default select example" required>
                            <option selected value="">Selecione</option>
                            @foreach($alunos as $aluno)
                                <option value="{{$aluno->id}}">{{$aluno->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="turma">Turma</label>
                        <select class="form-control" name="turma" aria-label="Default select example" required>
                            <option selected value="">Selecione</option>
                            @foreach($turmas as $turma)
                                <option value="{{$turma->id}}">{{$turma->nome_turma}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary mt-3">
                        Associar
                    </button>
                </div>
            </div>
        </div><!-- FIM DO CONTAINER -->
    </form>
@endsection




