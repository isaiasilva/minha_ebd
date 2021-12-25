@extends('layouts.template')

@section('cabecalho')
    Associar Professor
@endsection
@section('conteudo')
    @include('components.flash-message')
    <form method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="professor">Professor</label>
                        <select class="form-control" name="professor" aria-label="Default select example" required>
                            <option selected value="">Selecione</option>
                            @foreach($professores as $professor)
                                <option value="{{$professor->id}}">{{$professor->name}}</option>
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



