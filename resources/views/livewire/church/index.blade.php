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
                    @if (Auth::user()->perfil_id === 1)
                        <th scope="col">Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($igrejas as $igreja)
                    <tr>
                        <th scope="row">{{ $igreja->id }}</th>
                        <td>{{ $igreja->nome }}</td>
                    </tr>
                @endforeach
            </tbody>
    </div>
