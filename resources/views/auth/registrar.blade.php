@extends('layouts.inicio')

@section('cabecalho')
    Registro
@endsection

@section('conteudo')
    @include('components.errors')

    <form method="post">
        @csrf
        <div class="form-group">
            <label for="email">Nome</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <!-- VER A POSSIBILIDADE DE CRIAR UMA CLASSE DE PERFIL -->
        <div class="form-group">
            <label for="perfil">Perfil</label>
            <select class="form-select" name="perfil" aria-label="Default select example" required>
                <option selected value="">Selecione</option>
                <option value="PROFESSOR">Professor</option>
                <option value="ALUNO">Aluno</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estado_civil">Estado Civil</label>
            <select class="form-select" name="estado_civil" aria-label="Default select example" required>
                <option selected value="">Selecione</option>
                <option value="Solteiro(a)">Solteiro(a)</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Viuvo(a)">Viuvo(a)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" name="data_nascimento" id="data_nascimento" required class="form-control">
        </div>

        <div class="form-group">
            <label for="turma">Turma</label>
            <select class="form-select" name="turma_id" aria-label="Default select example" required>
                <option selected value="">Selecione</option>
                @foreach($turmas as $key => $turma)
                    <option value="{{ $turma->id  }}">{{ $turma->nome_turma  }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Confirma Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required min="1" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Registrar-se
        </button>


    </form>
@endsection
