@extends('layouts.template')

@section('cabecalho')
            Chamada {{ date('d/m/Y') }}
@endsection
@section('conteudo')
    @include('components.errors')
    @include('components.flash-message')
  <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Presença</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach($alunos as $i => $aluno)
                <form method="POST">
                    @csrf
                    <input type="hidden" name="turma" value="{{ $turma->id }}">
                    <input type="hidden" name="professor" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="aluno" value="{{ $aluno->id }}">
                    <tr>
                        <th scope="row">{{ $aluno->id }}</th>
                        <td>{{ $aluno->name }}</td>
                        <td>
                            <div class="form-check">
                                @if(\App\Http\Controllers\ChamadaController::verificaPresenca($aluno->id) === true)
                                    <input class="form-check-input" checked  name="{{ 'presenca' . $i }}"  type="checkbox"  id="flexCheckChecked" disabled>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Presença
                                    </label>
                                @else
                                    <input class="form-check-input" name="{{ 'presenca' . $i }}"  type="checkbox"  id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Pendente
                                    </label>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="d-flex justify-content-around">
                                @if(\App\Http\Controllers\ChamadaController::verificaPresenca($aluno->id) === true)
                                    <button class="btn-primary"  alt="Presença" disabled><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                    </form>
                                    <form>
                                        <button class="btn-warning" alt="Atraso" disabled><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                    </form>
                                    <form action="/user/excluir-presenca" METHOD="POST">
                                        @csrf
                                        <input type="hidden" name="aluno" value="{{ $aluno->id }}">
                                        <button class="btn-danger" alt="Excluir"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                    </form>
                             </span>
                                @else
                                    <button class="btn-primary"  alt="Presença"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                    <button class="btn-warning" alt="Atraso"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                    <button class="btn-danger" alt="Excluir" disabled><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                    </form>
                                @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
  </div>
@endsection


