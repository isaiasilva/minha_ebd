@extends('layouts.template')

@section('cabecalho')
    Associar Aluno
@endsection
@section('conteudo')
    @include('components.flash-message')
    <div class="table-responsive">
        <table class="table" id="datatablesSimple">
            <thead>
            <tr class="">
                <th scope="col">Aluno</th>
                <th scope="col">Turma</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
              @foreach($alunos as $aluno)
                <tr>
                    <form  method="post" >
                        @csrf
                        <input type="hidden" name="aluno" value="{{ $aluno->id }}">
                        <td>{{ $aluno->name }}</td>
                    <td>
                        <select class="form-control" name="turma" aria-label="Default select example" required>
                            <option selected value="">Selecione</option>
                            @foreach($turmas as $turma)
                                <option value="{{$turma->id}}">{{$turma->nome_turma}}</option>
                            @endforeach
                        </select>
                    </td>
                        <td>
                            <button type="submit" class="btn btn-primary">
                                Associar
                            </button>
                        </td>
                    </form>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
@endsection




