<!DOCTYPE html>
<html lang="pt-br">
@include('components.header')
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="sidebar-toggle text-light mr-3">
        <span class="navbar-toggler-icon"> </span>
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/missao-png.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
            Chamada EBD</a>
    </a>
    <div class="collapse navbar-collapse d-flex flex-row-reverse ">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                   <!-- <img class="rounded-circle" src="imagem/icon.png" width="20" height="20"> &nbsp;-->
                    <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Perfil</a>
                    <a class="dropdown-item" href="/sair"><i class="fas fa-sign-out-alt"></i> Sair</a>
                </div>
            </li>
        </ul>
    </div>
  </div>
</nav>

<div class="d-flex">
    <nav class="sidebar">
        <ul class="list-unstyled">
            <li><a href="{{ route('principal') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>

            <li>
                <a href="#submenu1" class="" data-toggle="collapse" aria-expanded="false" aria-controls="collapseUsuarios">
                    <i class="fas fa-user"></i> Usuário
                </a>
                <ul id="submenu1" class="list-unstyled collapse" id="collapseUsuarios">
                    <li><a href="{{route('usuarios')}}"><i class="fas fa-users"></i> Usuários</a></li>
                    @if(Auth::user()->perfil === "ADMINISTRADOR")
                        <li><a href="{{ route('register') }}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a></li>
                    @endif
                </ul>
            </li>

            <li>
                <a href="#submenu2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseUsuarios">
                    <i class="fas fa-user-graduate"></i> Alunos
                </a>
                <ul id="submenu2" class="list-unstyled collapse" id="collapseUsuarios">
                    <li><a href="{{ route('registrar-aluno') }}"><i class="fa fa-plus" aria-hidden="true"></i> Nova</a></li>
                    <li><a href="{{ route('alunos') }}"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</a></li>
                </ul>
            </li>

            <li>
                <a href="#submenu3" data-toggle="collapse" aria-expanded="false" aria-controls="collapseUsuarios">
                    <i class="bi bi-card-checklist"></i> Chamadas
                </a>
                <ul id="submenu3" class="list-unstyled collapse" id="collapseUsuarios">
                    <li><a href="{{ route('chamada') }}"><i class="fa fa-plus" aria-hidden="true"></i> Nova</a></li>
                    <li><a href="#"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</a></li>
                </ul>
            </li>

            <li>
                <a href="#submenu4" class="" data-toggle="collapse" aria-expanded="false" aria-controls="collapseUsuarios">
                    <i class="fas fa-graduation-cap"></i> Turmas
                </a>
                <ul id="submenu4" class="list-unstyled collapse" id="collapseUsuarios">
                    @if(Auth::user()->perfil === "ADMINISTRADOR")
                        <li><a href="{{ route('turma') }}"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a></li>
                    @endif
                        <li><a href="{{route('turmas')}}"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar</a></li>
                </ul>
            </li>

            <li><a href="/sair"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
        </ul>
    </nav>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">@yield('cabecalho')</h2>
                </div>
            </div>
            @yield('conteudo')
            </div>
        </div>
    </div>
</div>
@include('layouts.fim')
</body>
</html>

