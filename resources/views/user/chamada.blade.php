@extends('layouts.template')

@section('cabecalho')
            Chamada - {{$nomeTurma}}
@endsection

@if(Auth::user()->perfil_id !== "2")
@section('botao')

    <div class="btn-group">
        <button type="button" class="btn btn-info  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-exchange-alt"></i> Alterar
        </button>
        @if(Auth::user()->perfil_id === "1")
            <div class="dropdown-menu altera-curso">
                @foreach($turmas->all() as $turma)
                    <a class="dropdown-item" href="/user/chamada/{{$turma->id}}">{{ $turma->nome_turma}}</a>
                @endforeach
            </div>
        @else
            <div class="dropdown-menu altera-curso">
                @foreach($minhasTurmas as $minhaTurma)
                    <a class="dropdown-item" href="/user/chamada/{{$minhaTurma->turma_id}}">{{$turmas->find($minhaTurma->turma_id)->nome_turma}}</a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
@endif

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
                        <td>{{ $aluno->nome }}</td>
                        <form action="{{route('chamada')}}" method="POST">
                            @csrf
                            <input type="hidden" name="turma" value="{{ $turmaAtual }}">
                            <input type="hidden" name="professor" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="aluno" value="{{ $aluno->aluno_id }}">
                        <td>
                            <div class="form-check">
                                @if($aluno->presenca !== "Pendente")
                                    <div class="d-flex flex-column">
                                        <div class="mb-2">
                                            <input class="form-check-input" checked  name=""  type="checkbox"  id="{{$i}}" disabled>
                                            <label class="form-check-label" for="{{$i}}">
                                                {{$aluno->presenca }}
                                            </label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="form-check-input" {{ $aluno->material }} name="material"  type="checkbox"  disabled id="material_didatico" required>
                                            <label class="form-check-label" for="material_didatico">
                                                Material Didático
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex flex-column">
                                        <div class="mb-2">
                                            <input class="form-check-input" name="atraso"  type="checkbox"  id="{{ 'presenca' . $i }}" >
                                            <label class="form-check-label" for="{{ 'presenca' . $i }}">
                                                Atraso
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" name="material"  type="checkbox"  id="{{ 'material' . $i }}" >
                                            <label class="form-check-label" for="{{ 'material' . $i }}">
                                                Material Didático
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                @if($aluno->presenca === "Pendente")
                                    <button type="submit" class="btn btn-primary btn-sm mr-3"  alt="Presença" ><i class="fas fa-stopwatch"></i> Registrar</button>
                                    <button class="btn btn-danger btn-sm mr-3" alt="Excluir" disabled><i class="fa fa-eraser" aria-hidden="true"></i> Deletar</button>
                                @else
                                    <button class="btn btn-primary btn-sm mr-3"  alt="Presença" disabled><i class="fas fa-stopwatch"></i> Registrar</button>
                                    <a href="{{'/user/excluir-presenca/'. $aluno->turmaAtual . '/' . $aluno->aluno_id}}" class="btn btn-danger btn-sm mr-3"><i class="fa fa-eraser" aria-hidden="true"></i> Deletar</a>
                                @endif
                            </div>
                        </form>
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
  </div>
@endsection


