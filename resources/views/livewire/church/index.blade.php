<div>
    <div class="d-flex justify-content-between align-items-center">

        @section('cabecalho')
            Igrejas
        @endsection

        @section('botao')
            <a href="{{ route('igrejas.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Nova igreja
            </a>
        @endsection
    </div>


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">EBD</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($igrejas as $igreja)
                    <tr>
                        <th scope="row">{{ $igreja->id }}</th>
                        <td>{{ $igreja->nome }}</td>
                        <td>{{ $igreja->dia_ebd }} de {{ $igreja->horario }}</td>
                        <td>

                            <p class="text-center pointer" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </p>

                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('igrejas.edit', ['id' => $igreja->id]) }}">Editar</a>
                                <a class="dropdown-item" href="#"
                                    onclick="return confirm('Você tem certeza? Essa ação não poderá ser desfeita') ||  event.stopImmediatePropagation()"
                                    wire:click='destroy({{ $igreja->id }})'>Excluir</a>
                                <a class="dropdown-item"
                                    href="{{ route('igrejas.show', ['id' => $igreja->id]) }}">Visualizar</a>

                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $igrejas->links() }}
    </div>
</div>
