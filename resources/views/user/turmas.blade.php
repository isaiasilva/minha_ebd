@extends('layouts.template')

@section('cabecalho')
    Turmas
@endsection
@section('conteudo')
    @include('components.flash-message')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="">
                <th scope="col">#ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($turmas as $turma)
                    <tr>
                        <td>{{ $turma->id }}</td>
                        <td>{{ $turma->nome_turma }}</td>
                        <td>
                            <span class="d-flex justify-content-around">
                                <button class="btn-primary"  alt="Editar"><i class="fas fa-edit"></i></button>
                                <form action="{{route('excluir-turma')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="turma_id" value="{{ $turma->id }}">
                                    <button class="btn-danger" alt="Excluir" ><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection



