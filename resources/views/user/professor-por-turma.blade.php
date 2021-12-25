@extends('layouts.template')

@section('cabecalho')
    Professor por Turma
@endsection
@section('conteudo')
    @include('components.flash-message')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="">
                <th scope="col">Professor</th>
                <th scope="col">Turma</th>
                @if(Auth::user()->perfil_id === "1" )
                    <th scope="col">Ações</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($professorPorTurma as $professor)
                <tr>
                    <td>{{ $usuario->find($professor->professor_id)->name }}</td>
                    <td>{{ $turma->find($professor->turma_id)->nome_turma }}</td>
                    @if(Auth::user()->perfil_id === "1")
                        <td>
                                <span class="d-flex justify-content-around">
                                    <button class="btn btn-primary"  alt="Editar"><i class="fas fa-edit"></i></button>
                                    <form action="{{route('excluir-turma')}}" method="post" onsubmit="return confirm('Tem certeza?')" >
                                        @csrf
                                        <input type="hidden" name="turma_id" value="{{ $turma->id }}">
                                        <button class="btn btn-danger" alt="Excluir"  ><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                    </form>
                                </span>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection




