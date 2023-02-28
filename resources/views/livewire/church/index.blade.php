<div>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            @section('cabecalho')
                Igrejas
            @endsection
        </div>

        <a href="{{ route('igrejas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nova igreja
        </a>
    </div>


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">EBD</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($igrejas as $igreja)
                    <tr>
                        <th scope="row">{{ $igreja->id }}</th>
                        <td>{{ $igreja->nome }}</td>
                        <td>{{ $igreja->dia_ebd }} de {{ $igreja->horario }}</td>
                        <td>

                            <p class="" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </p>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Excluir</a>
                                <a class="dropdown-item" href="#">Visualizar</a>

                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
    </div>
