@extends('layouts.template')

@section('cabecalho')
    Página Inicial
@endsection
@if(Auth::user()->perfil_id !== "2")
    @section('botao')
        <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                Alterar turma
            </button>
            @if(Auth::user()->perfil_id === "1")
                <div class="dropdown-menu">
                    @foreach($turma->all() as $todas_turmas)
                        <a class="dropdown-item" href="/user/atualiza-turma/{{$todas_turmas->id}}">{{ $todas_turmas->nome_turma}}</a>
                    @endforeach
                </div>
            @else
                <div class="dropdown-menu">
                    @foreach($turmas as $professorTurma)
                        <a class="dropdown-item" href="/user/atualiza-turma/{{$professorTurma->turma_id}}">{{ $turma->find($professorTurma->turma_id)->nome_turma}}</a>
                    @endforeach
                </div>
            @endif
        </div>
    @endsection
@endif

@section('conteudo')
    @include('components.flash-message')
    <div class="content p-1">
    <p>Hoje é {{ date('d/m/Y') }}</p>
    </div>

<div class="content p-1">
        <div class="row mb-3">
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <i class="fas fa-user fa-3x"></i>
                        <h6 class="card-title">Usuário</h6>
                        <h2 class="lead">{{ Auth::user()->name }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <i class="fa fa-graduation-cap fa-3x" aria-hidden="true"></i>
                        <h6 class="card-title">Perfil</h6>
                        <h2 class="lead">{{ ucfirst(strtolower($perfil->perfil)) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x"></i>
                        <h6 class="card-title">Turma</h6>
                        <h2 class="lead">{{ $turmaAtual->nome_turma }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="fa fa-list-alt fa-3x"></i>
                        <h6 class="card-title">Presenças</h6>
                        <h2 class="lead">{{$presencas}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

