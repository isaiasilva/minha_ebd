<div>
    @section('cabecalho')
        Associar Aluno
    @endsection
    <div class="row breadcrumbs-top d-inline-block">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('principal') }}">Home</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Associar Aluno</a>
                </li>
            </ol>
        </div>
    </div>
    <section class="row d-md-flex justify-content-between align-items-center">

        <div class="col-12 col-sm-6 mt-2 mt-md-0">
            <input class="form-control" type="text" placeholder="Filtre" wire:model='search'>
        </div>
        <div class="col-12 col-md-6 text-right">
            <label for='perpage' class="ps-3">Registros por página</label>
            <select id='perpage' wire:model="perpage" class="form-select my-3">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
    </section>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="">
                            <th scope="col">Aluno</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alunos as $aluno)
                            <tr>
                                <form method="post">
                                    @csrf
                                    <input type="hidden" name="aluno" value="{{ $aluno->user->id }}">
                                    <td>{{ $aluno->user->name }}</td>
                                    <td>
                                        <select class="form-control" name="turma" aria-label="Default select example"
                                            required>
                                            <option selected value="">Selecione</option>
                                            @foreach ($turmas as $turma)
                                                <option value="{{ $turma->id }}">{{ $turma->nome_turma }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">
                                            Associar
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $alunos->links() }}
    </div>
</div>
