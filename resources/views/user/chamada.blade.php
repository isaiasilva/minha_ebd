@extends('layouts.template')

@section('cabecalho')
            Chamada {{ date('d/m/Y') }}
@endsection
@section('conteudo')
    @include('components.flash-message')
  <div class="table-responsive">
    <table class="table">
        <thead>
        <tr class="text-center">
            <th scope="col">Nome</th>
            <th scope="col">Presença</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
            @foreach($alunos as $i => $aluno)
                    <tr>
                        <td>{{ $aluno->name }}</td>
                        <td>
                            <div class="form-check">
                                @if(\App\Http\Controllers\ChamadaController::verificaPresenca($aluno->id) !== "Pendente")
                                    <input class="form-check-input" checked  name="{{ 'presenca' . $i }}"  type="checkbox"  id="flexCheckChecked" disabled>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        {{\App\Http\Controllers\ChamadaController::verificaPresenca($aluno->id) }}
                                    </label>
                                @else
                                    <input class="form-check-input" name="{{ 'presenca' . $i }}"  type="checkbox"  id="flexCheckChecked" required>
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Pendente
                                    </label>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="d-flex justify-content-around">
                                @if(\App\Http\Controllers\ChamadaController::verificaPresenca($aluno->id) !== "Pendente")
                                    <button class="btn btn-primary"  alt="Presença" disabled><i class="fas fa-stopwatch"></i></button>
                                    <button class="btn btn-warning" alt="Atraso" disabled><i class="fas fa-user-clock"></i></button>

                                    <form action="/user/excluir-presenca" METHOD="POST" onsubmit="return confirm('Tem certeza que quer apagar a presença?')">
                                        @csrf
                                        <input type="hidden" name="aluno" value="{{ $aluno->id }}">
                                        <button class="btn btn-danger" alt="Excluir"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                    </form>
                             </span>
                                @else
                                <form action="{{route('chamada')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="turma" value="{{ $turma->id }}">
                                    <input type="hidden" name="professor" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="aluno" value="{{ $aluno->id }}">
                                    <input type="hidden" name="atraso" value="false">
                                    <button type="submit" class="btn btn-primary"  alt="Presença" ><i class="fas fa-stopwatch"></i></button>
                                </form>

                                <form action="{{route('atraso')}}" METHOD="POST">
                                    @csrf
                                    <input type="hidden" name="turma" value="{{ $turma->id }}">
                                    <input type="hidden" name="professor" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="aluno" value="{{ $aluno->id }}">
                                    <input type="hidden" name="atraso" value="true">
                                    <button type="submit"  class="btn btn-warning" alt="Atraso" ><i class="fas fa-user-clock"></i></button>
                                </form>
                                <button class="btn btn-danger" alt="Excluir" disabled><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
  </div>
@endsection


