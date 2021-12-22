<!DOCTYPE html>
<html lang="pt-br">
@include('components.header')
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="sidebar-toggle text-light mr-3">
        <span class="navbar-toggler-icon"> </span>
        <a class="navbar-brand" href="#"> Chamada EBD</a>
    </a>
    <div class="collapse navbar-collapse d-flex flex-row-reverse ">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle menu-header" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
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
                <a href="#submenu1" class="accordion-collapse" data-toggle="collapse">
                    <i class="fas fa-user"></i> Usuário
                </a>
                <ul id="submenu1" class="list-unstyled collapse">
                    <li><a href="{{route('usuarios')}}"><i class="fas fa-users"></i> Usuários</a></li>
                    <li><a href="#"><i class="fas fa-key"></i> Nível de Acesso</a></li>
                </ul>
            </li>


            <li><a href="{{ route('alunos') }}"><i class="fa fa-users" aria-hidden="true"></i> Alunos</a></li>
            <li><a href="{{ route('chamada') }}"><i class="bi bi-card-checklist"></i> Chamada</a></li>
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
</body>
</html>

