@extends('layouts.template')

@section('cabecalho')
    Usuários
@endsection
@section('conteudo')
    @include('components.flash-message')
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Nascimento</th>
            <th scope="col">Perfil</th>
            @if(Auth::user()->perfil_id === "1")
                <th scope="col">Ações</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{ $usuario->id }}</th>
                <td>{{ $usuario->name }}</td>
                <td>{{  date('d/m/Y', strtotime( $usuario->data_nascimento))  }}</td>
                <td>{{ $perfil->find($usuario->perfil_id)->perfil }} </td>
                @if(Auth::user()->perfil_id === "1")
                 <td>
                    <span class="d-flex justify-content-around">
                        <a href="/user/usuario/{{$usuario->id }}/editar" class="btn btn-primary"><i class="fas fa-edit"></i> </a>

                           <form action="/user/usuario/{{$usuario->id }}" method="get" onsubmit="return confirm('Tem certeza? Todos os registros serão apagados e não poderão ser recuperados.')" >
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


