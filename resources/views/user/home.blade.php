<x-app-layout class="content-body">
    @section('cabecalho')
        Página Inicial - {{ $igreja->igreja->nome }}
    @endsection


    @include('components.flash-message')
    <div class="">
        <p>Hoje é {{ date('d/m/Y') }}</p>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{ Auth::user()->name }}</h3>
                                <h6>Usuário</h6>
                            </div>
                            <div>
                                <i class="fas fa-user info font-large-2 float-right"></i>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning">{{ ucfirst(strtolower(Auth::user()->perfil->perfil)) }}</h3>
                                <h6>Perfil</h6>
                            </div>
                            <div>
                                <i class="fa fa-graduation-cap warning font-large-2 float-right"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                @foreach ($turmas as $turma)
                                    <h3 class="success">{{ $turma->turma->nome_turma }}</h3>
                                @endforeach

                                <h6>Turmas(s)</h6>
                            </div>
                            <div>
                                <i class="fa fa-users success font-large-2 float-right"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger">{{ $presencas }}</h3>
                                <h6>Presenças</h6>
                            </div>
                            <div>
                                <i class="fa fa-list-alt danger font-large-2 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row match-height">
        <div class="col-xl-8 col-12" id="ecommerceChartView">
            <div class="card card-shadow">
                <div class="card-header card-header-transparent py-20">
                    <div class="btn-group dropdown">
                        <span class="text-body dropdown-toggle blue-grey-700">
                            Frequência por mês
                        </span>
                    </div>

                </div>
                <div class="widget-content tab-content bg-white p-20"><canvas id="myBarChart" width="100%"
                        height="40"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Orders</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content">
                    <div id="new-orders" class="media-list position-relative">
                        <div class="table-responsive">
                            <table id="new-orders-table" class="table table-hover table-xl mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Product</th>
                                        <th class="border-top-0">Customers</th>
                                        <th class="border-top-0">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-truncate">iPhone X</td>
                                        <td class="text-truncate p-1">
                                            <ul class="list-unstyled users-list m-0">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="John Doe" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-19.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Katherine Nichols"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-18.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Joseph Weaver"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-17.png"
                                                        alt="Avatar">
                                                </li>
                                                <li class="avatar avatar-sm">
                                                    <span class="badge badge-info">+4 more</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-truncate">$8999</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">Pixel 2</td>
                                        <td class="text-truncate p-1">
                                            <ul class="list-unstyled users-list m-0">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Alice Scott" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-16.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Charles Miller"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-15.png"
                                                        alt="Avatar">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-truncate">$5550</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">OnePlus</td>
                                        <td class="text-truncate p-1">
                                            <ul class="list-unstyled users-list m-0">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Christine Ramos"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-11.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Thomas Brewer"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-10.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Alice Chapman"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-9.png"
                                                        alt="Avatar">
                                                </li>
                                                <li class="avatar avatar-sm">
                                                    <span class="badge badge-info">+3 more</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-truncate">$9000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">Galaxy</td>
                                        <td class="text-truncate p-1">
                                            <ul class="list-unstyled users-list m-0">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Ryan Schneider"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-14.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Tiffany Oliver"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-13.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Joan Reid" class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-12.png"
                                                        alt="Avatar">
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-truncate">$7500</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">Moto Z2</td>
                                        <td class="text-truncate p-1">
                                            <ul class="list-unstyled users-list m-0">
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Kimberly Simmons"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-8.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Willie Torres"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-7.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-original-title="Rebecca Jones"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="media-object rounded-circle"
                                                        src="../../../app-assets/images/portrait/small/avatar-s-6.png"
                                                        alt="Avatar">
                                                </li>
                                                <li class="avatar avatar-sm">
                                                    <span class="badge badge-info">+1 more</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="text-truncate">$8500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
