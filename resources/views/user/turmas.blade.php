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
                @if(Auth::user()->perfil_id === 1 )
                    <th scope="col">Ações</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($turmas as $turma)
                    <tr>
                        <td>{{ $turma->id }}</td>
                        <td>{{ $turma->nome_turma }}</td>
                        @if(Auth::user()->perfil_id === 1)
                            <td>
                                <span class="d-flex justify-content-around">
                                    <a href="/user/turma/{{$turma->id}}/editar" class="btn btn-primary"  alt="Editar"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('excluir-turma')}}" method="post" onsubmit="return confirm('Tem certeza? Os dados serão apagados permanentemente.')" >
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="turma_id" value="{{ $turma->id }}" >
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



