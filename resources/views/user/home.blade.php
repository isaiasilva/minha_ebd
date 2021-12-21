@extends('layouts.template')

@section('cabecalho')
    Página Inicial
@endsection

@section('conteudo')

Usuário:
{{ Auth::user()->name }}
<br>
Perfil:
{{ Auth::user()->perfil }}
<br>
Turma:
{{ $turma->nome_turma }}
<br>

Logout:
<a href="/sair">Sair</a>
<br>

<h2>Alunos</h2>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Matricula</th>
        <th scope="col">Nome</th>
        <th scope="col">Presença</th>
    </tr>
    </thead>
    <tbody>
    <form method="POST">
        @csrf
    @foreach($alunos as $aluno)
        <tr>
            <th scope="row">{{ $aluno->id }}</th>
            <td>{{ $aluno->name }}</td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Presença
                    </label>
                </div>
            </td>
        </tr>
    @endforeach


    </tbody>
</table>

<button type="submit" class="btn btn-primary mt-3">
    Registrar presença
</button>
</form>

@endsection

