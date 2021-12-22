@extends('layouts.template')

@section('cabecalho')
    Usuários
@endsection
@section('conteudo')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Matricula</th>
            <th scope="col">Nome</th>
            <th scope="col">Nascimento</th>
            <th scope="col">Perfil</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <th scope="row">{{ $usuario->id }}</th>
                <td>{{ $usuario->name }}</td>
                <td>{{  date('d/m/Y', strtotime( $usuario->data_nascimento))  }}</td>
                <td>{{ $usuario->perfil}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


