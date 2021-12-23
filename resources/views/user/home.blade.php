@extends('layouts.template')

@section('cabecalho')
    Página Inicial
@endsection

@section('conteudo')
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
                        <h2 class="lead">{{ Auth::user()->perfil }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x"></i>
                        <h6 class="card-title">Turma</h6>
                        <h2 class="lead">{{ $turma->nome_turma }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="fa fa-list-alt fa-3x"></i>
                        <h6 class="card-title">Presenças</h6>
                        <h2 class="lead">17</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

