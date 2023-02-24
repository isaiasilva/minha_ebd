<x-app-layout>
    @section('cabecalho')
        Chamadas Por Turma @if (isset($nomeTurma))
            - {{ $nomeTurma }}
        @endif
    @endsection
    @section('botao')
        <div class="btn-group">
            <button type="button" class="btn btn-info  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-exchange-alt"></i> Alterar
            </button>
            <div class="dropdown-menu altera-curso">
                @foreach ($turmas as $turma)
                    <a class="dropdown-item"
                        href="/user/visualizar-chamadas-por-turma/{{ $turma->id }}">{{ $turma->nome_turma }}</a>
                @endforeach
            </div>

        </div>
    @endsection


    <div class="content p-1">
        <div class="row mb-3">
            <div class="col-lg col-sm-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x"></i>
                        <h6 class="card-title">N° Alunos</h6>
                        <h2 class="lead">{{ $usuarios }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <i class="fas fa-list fa-3x"></i>
                        <h6 class="card-title">Presenças</h6>
                        <h2 class="lead">{{ $presencas }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <i class="fas fa-exclamation fa-3x"></i>
                        <h6 class="card-title">N° Atrasos</h6>
                        <h2 class="lead">{{ $atrasos }}</h2>
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
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="20"></canvas></div>
                </div>
            </div>
        </div> <!-- End row -->
        <div class="container">
            <div class="row mb-3">
                <div class="table-responsive">
                    <table class="table" id="datatablesSimple">
                        <thead>
                            <tr class="">
                                <th scope="col">Alunos</th>
                                <th scope="col">N° Chamadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->nome }}</td>
                                    <td>{{ $aluno->presencas }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> <!-- End row -->
        </div>


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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/frequencias.js') }}"></script>
</x-app-layout>
