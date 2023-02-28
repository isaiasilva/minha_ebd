<x-app-layout>
    @section('cabecalho')
        Página Inicial - {{ $igreja->igreja->nome }}
    @endsection


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
                        <h2 class="lead">{{ ucfirst(strtolower(Auth::user()->perfil->perfil)) }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x"></i>
                        <h6 class="card-title">Turma(s)</h6>
                        @foreach ($turmas as $turma)
                            <h2 class="lead">{{ $turma->turma->nome_turma }}</h2>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="fa fa-list-alt fa-3x"></i>
                        <h6 class="card-title">Minhas Presenças</h6>
                        <h2 class="lead">{{ $presencas }}</h2>
                    </div>
                </div>
            </div>

        </div> <!-- End row -->


        <div class="row mb-3">

            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Frequência por mês
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        @if ($igreja->igreja->id == 1)
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area"></i>
                            Alunos por sala
                        </div>
                        <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div> <!-- End row -->
        @endif


    </div> <!-- End container -->
    <input type="hidden" value="{{ $jan }}" id="jan">
    <input type="hidden" value="{{ $fev }}" id="fev">
    <input type="hidden" value="{{ $mar }}" id="mar">
    <input type="hidden" value="{{ $abr }}" id="abr">
    <input type="hidden" value="{{ $mai }}" id="mai">
    <input type="hidden" value="{{ $jun }}" id="jun">
    <input type="hidden" value="{{ $jul }}" id="jul">
    <input type="hidden" value="{{ $ago }}" id="ago">
    <input type="hidden" value="{{ $set }}" id="set">
    <input type="hidden" value="{{ $out }}" id="out">
    <input type="hidden" value="{{ $nov }}" id="nov">
    <input type="hidden" value="{{ $dez }}" id="dez">

    <input type="hidden" value="{{ $adolescentes }}" id="adolescentes">
    <input type="hidden" value="{{ $adultos }}" id="adultos">
    <input type="hidden" value="{{ $discipulado }}" id="discipulado">
    <input type="hidden" value="{{ $jInfancia }}" id="jInfancia">
    <input type="hidden" value="{{ $juniores }}" id="juniores">
    <input type="hidden" value="{{ $jovens }}" id="jovens">
    <input type="hidden" value="{{ $primarios }}" id="primarios">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/chart-pie-demo.js') }}"></script>
</x-app-layout>
