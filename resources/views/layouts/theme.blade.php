<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
        content="Chamada EBD - Sistema de cadastro de alunos e registro de chamadas para Escola Bíblica Dominical.">
    <meta name="keywords" content="Escola Bíblica Dominical, EBD, Chamada, Gameficação, Alunos" />
    <meta name="robots" content="index,follow">
    <meta name="author" content="Chamada EBD - Cláudio Oliveira">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <meta property="og:title" content="Chamada EBD">
    <meta property="og:site_name" content="Chamada EBD">
    <meta property="og:description"
        content="Chamada EBD - Sistema de cadastro de alunos e registro de chamadas para Escola Bíblica Dominical.">
    <meta property="og:url" content="https://chamadaebd.com.br/">
    <meta property="og:image" content="https://chamadaebd.com.br/img/logo.png">
    <meta property="og:image:type" content="image/png">
    <title>Chamado EBD</title>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/meteocons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/morris.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/chartist.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/charts/chartist-plugin-tooltip.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/timeline.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}">
</head>

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- BEGIN: Header-->
    <nav
        class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto"><a
                            class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('principal') }}"><img
                                class="brand-logo" alt="modern admin logo" src="{{ asset('img/missao-png.png') }}">
                            <h3 class="brand-text">Minha EBD</h3>
                        </a></li>
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0"
                            data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"
                                data-ticon="ft-toggle-right"></i></a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                            data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                    class="ficon ft-maximize"></i></a></li>
                    </ul>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a
                                class="dropdown-toggle nav-link dropdown-user-link" href="#"
                                data-toggle="dropdown"><span
                                    class="mr-1 user-name text-bold-700">{{ auth()->user()->name }}</span><span
                                    class="avatar avatar-online"><img src="{{ asset(auth()->user()->path_photo) }}"
                                        alt="avatar" width="35" height="35"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                    href="{{ route('alterar-senha') }}"><i class="ft-user"></i> Alterar senha</a>
                                <a class="dropdown-item" href="{{ route('perfil') }}"><i class="ft-user"></i>
                                    Perfil</a>

                                <div class="dropdown-divider"></div><a class="dropdown-item" href="/sair"><i
                                        class="ft-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation">
                <li><a href="{{ route('principal') }}"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="Dashboard"> Dashboard</span></a>
                </li>


                <li class=" navigation-header">MENU<i class="la la-ellipsis-h" data-toggle="tooltip"
                        data-placement="right" data-original-title="User Interface"></i>
                </li>
                @if (Auth::user()->perfil_id === App\Models\Perfil::ADMINISTRADOR)
                    <li class=" nav-item"><a href="#"><i class="fas fa-user-cog mr-1"></i>
                            <span class="menu-title">Administração</span>
                        </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{ route('usuarios') }}"><i
                                        class="fas fa-users mr-1"></i><span data-i18n="">Usuários</span></a>
                            </li>
                            <li><a class="menu-item" href="{{ route('register') }}"><i class="fa fa-plus mr-1"
                                        aria-hidden="true"></i><span data-i18n="">Novo</span></a>
                            </li>
                            <li><a class="menu-item" href="{{ route('igrejas.index') }}"><i
                                        class="fas fa-church mr-1"></i><span
                                        data-i18n="Invoice List">Igrejas</span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class=" nav-item"><a href="#"><i class="fas fa-user mr-1"></i><span class="menu-title"
                            data-i18n="Components">Usuário</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('usuarios') }}"><i
                                    class="fas fa-users mr-1"></i><span data-i18n="Alerts">Usuários</span></a>
                        </li>
                        @if (Auth::user()->perfil_id === App\Models\Perfil::ADMINISTRADOR ||
                                Auth::user()->perfil_id === App\Models\Perfil::SUPERINTENDENTE)
                            <li><a class="menu-item" href="{{ route('registrar.index') }}"><i
                                        class="fa fa-plus mr-1" aria-hidden="true"></i><span
                                        data-i18n="Callout">Novo</span></a>
                            </li>
                        @endif


                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="fas fa-user-graduate mr-1"></i><span
                            class="menu-title" data-i18n="Authentication">Alunos</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('alunoPorTurma') }}"><i
                                    class="fas fa-chalkboard-teacher mr-1"></i><span>Alunos por turma</span></a>
                        </li>
                        @if (Auth::user()->perfil_id !== 2)
                            <li>
                                <a class="menu-item" href="{{ route('associar-aluno') }}">
                                    <i class="fa fa-plus mr-1"></i>
                                    <span>Associar Aluno</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class=" nav-item"><a href="#" class="menu-title"><i
                            class="fas fa-list mr-1"></i>Chamadas</a>
                    <ul class="menu-content">
                        @if (Auth::user()->perfil_id !== 2)
                            <li><a class="menu-item" href="{{ route('chamada') }}"><i class="fa fa-plus"
                                        aria-hidden="true"></i>
                                    Nova</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('todas-chamadas') }}"><i class="fa fa-eye"
                                        aria-hidden="true"></i>
                                    Todas Chamadas</a></li>
                        @endif
                        <li><a class="menu-item" href="{{ route('visualizar-chamadas') }}"><i class="fa fa-eye"
                                    aria-hidden="true"></i>
                                Visualizar</a></li>

                    </ul>
                </li>
                <li class=" nav-item"><a href="{{ route('material.index') }}"><i class="la la-file-text"></i><span
                            class="menu-title" data-i18n="Form Layouts">Material de Apoio</span></a>

                </li>

                <li class=" nav-item"><a href="#"><i class="fas fa-chalkboard-teacher mr-1"></i><span
                            class="menu-title" data-i18n="Bootstrap Tables">Professores</span></a>
                    <ul class="menu-content">
                        @if (Auth::user()->perfil_id === App\Models\Perfil::ADMINISTRADOR ||
                                Auth::user()->perfil_id === App\Models\Perfil::SUPERINTENDENTE)
                            <li><a class="menu-item" href="{{ route('associar-professor') }}"><i class="fa fa-plus"
                                        aria-hidden="true"></i> Associar Professor</a></li>
                        @endif
                        <li><a class="menu-item" href="{{ route('professorPorTurma') }}"><i class="fa fa-eye"
                                    aria-hidden="true"></i>
                                Professor por Turma</a></li>

                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="fas fa-graduation-cap mr-1"></i><span
                            class="menu-title" data-i18n="Chartjs">Turmas</span></a>
                    <ul class="menu-content">
                        @if (Auth::user()->perfil_id === App\Models\Perfil::ADMINISTRADOR ||
                                Auth::user()->perfil_id === App\Models\Perfil::SUPERINTENDENTE)
                            <li><a class="menu-item" href="{{ route('turma') }}"><i class="fas fa-chalkboard"></i>
                                    Nova turma</a></li>
                        @endif
                        <li><a class="menu-item" href="{{ route('turmas') }}"><i class="fa fa-eye"
                                    aria-hidden="true"></i>
                                Visualizar</a></li>
                    </ul>
                </li>
                @if (Auth::user()->perfil_id === App\Models\Perfil::ADMINISTRADOR)
                    <li class=" nav-item"><a href="#"><i class="fas fa-graduation-cap mr-1"></i><span
                                class="menu-title" data-i18n="Chartjs">Relatórios</span></a>
                        <ul class="menu-content">

                            <li><a href="{{ route('alunos.relatorio') }}"><i class="fas fa-chalkboard"></i> Alunos
                                    Por
                                    Turma</a></li>
                        </ul>
                    </li>
                @endif
                <li><a href="{{ route('gamiicacao') }}"><i class="fas fa-gamepad mr-1"></i> Gameficação</a></li>
            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="mr-auto d-flex justify-content-between">
                    <h1 class="display-4 titulo">@yield('cabecalho')</h1>
                    <div class=" py-2">@yield('botao')</div>
                </div>

            </div>
            {{ $slot }}
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
                class="float-md-left d-block d-md-inline-block">Copyright &copy; {{ date('Y') }} <a
                    class="text-bold-800 grey darken-2" href="https://chamadaebd.com.br" target="_blank">Minha
                    EBD</a></span></p>
    </footer>
    <!-- END: Footer-->
    @livewireScripts
    <script defer src="{{ asset('js/dataTables.js') }}"></script>
    <script defer src="{{ asset('js/datatables-demo.js') }}"></script>
    <script defer src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <script src="{{ asset('app-assets/vendors/js/charts/chartist.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/raphael-min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/morris.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/timeline/horizontal-timeline.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
    <!-- END: Page JS-->
</body>

</html>
