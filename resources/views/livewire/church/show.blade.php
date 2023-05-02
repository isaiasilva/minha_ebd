<div>
    @section('cabecalho')
        {{ $igreja->nome }}
    @endsection

    <div class="p-1">
        <div class="row mb-3">
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <i class="fas fa-user fa-3x"></i>
                        <h6 class="card-title">Usuários</h6>
                        <h2 class="lead">{{ $igreja->users->count() }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <i class="fa fa-graduation-cap fa-3x" aria-hidden="true"></i>
                        <h6 class="card-title">Categoria</h6>
                        <h2 class="lead">{{ $igreja->tipo_igreja }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="fa fa-users fa-3x"></i>
                        <h6 class="card-title">Número de Turmas</h6>

                        <h2 class="lead">{{ $igreja->turmas->count() }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="fa fa-list-alt fa-3x"></i>
                        <h6 class="card-title">Presenças</h6>
                        <h2 class="lead">{{ $presencas }}</h2>
                    </div>
                </div>
            </div>
        </div> <!-- End row -->

        <div class="row">
            <div class="col-md-6">
                <p><strong> Pastor:</strong> {{ $igreja->pastor }} </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <p><strong>Endereço:</strong> {{ $igreja->endereco }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <p><strong>Dia de Estudo:</strong> {{ $igreja->dia_ebd }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <p><strong>Horário das aulas:</strong> {{ $igreja->horario }}</p>
            </div>
        </div>

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

    </div> <!-- End container -->




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/chart-pie-demo.js') }}"></script>
</div>
