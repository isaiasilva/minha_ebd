@extends('layouts.template')

@section('cabecalho')
    Aluno por Turma
@endsection
@section('conteudo')
    @include('components.flash-message')
    <div class="table-responsive">
        <table class="table" id="datatablesSimple">
            <thead>
                <tr class="">
                    <th scope="col">Aluno</th>
                    <th scope="col">Turma</th>
                    @if (Auth::user()->perfil_id === 1)
                        <th scope="col">Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($alunosPorTurma as $aluno)
                    <tr>
                        <td>{{ $aluno->aluno->name }}</td>
                        <td>{{ $aluno->turma->nome_turma }}</td>
                        @if (Auth::user()->perfil_id === 1)
                            <td>
                                <form action="{{ route('excluir-aluno') }}" method="post"
                                    onsubmit="return confirm('Tem certeza?')">
                                    @csrf
                                    <input type="hidden" name="aluno_id" value="{{ $aluno->user_id }}">
                                    <input type="hidden" name="turma_id" value="{{ $aluno->turma_id }}">
                                    <button class="btn btn-danger" alt="Excluir"><i class="fa fa-eraser"
                                            aria-hidden="true"></i></button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
