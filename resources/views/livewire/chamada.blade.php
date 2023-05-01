<div>
    <div class="row">
        <div class="col d-flex justify-content-between">
            @section('cabecalho')
                Chamada - {{ $turma->nome_turma }}
            @endsection
            @section('botao')
                <div class="btn-group">
                    <button type="button" class="btn btn-info  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-exchange-alt"></i> Alterar
                    </button>
                    @if (Auth::user()->perfil_id == App\Models\Perfil::SUPERINTENDENTE ||
                            Auth::user()->perfil_id == App\Models\Perfil::ADMINISTRADOR)
                        <div class="dropdown-menu altera-curso">
                            @foreach ($turmas->all() as $turma)
                                <a class="dropdown-item"
                                    href="/user/chamada/{{ $turma->id }}">{{ $turma->nome_turma }}</a>
                            @endforeach
                        </div>
                    @else
                        <div class="dropdown-menu altera-curso">
                            @foreach ($minhasTurmas as $minhaTurma)
                                <a class="dropdown-item"
                                    href="/user/chamada/{{ $minhaTurma->id }}">{{ $minhaTurma->nome_turma }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endsection
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <label for="data-chamada">Data </label>
            <input class="form-control" type="date" value="" wire:model='data'>
            @error('data')
                <p>{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="row d-md-flex justify-content-between align-items-center">

        <div class="col-12 col-sm-6 ">
            <input class="form-control" type="text" placeholder="Filtre pelo nome" wire:model='search'>
        </div>
        <div class="col-12 col-md-6 text-right">
            <label for='perpage' class="ps-3">Registros por página</label>
            <select id='perpage' wire:model="perpage" class="form-select m-3" aria-label="Default select example">
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>

    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">Nome</th>
                    <th scope="col">Presença</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $alunos as $i => $aluno )
                    <tr>
                        <td class="row">
                            <div class="col">
                                <img class="rounded-circle" src="{{ asset($aluno->aluno->path_photo) }}" width="60"
                                    height="60">
                            </div>
                            <div class="col ">
                                {{ $aluno->aluno->name }}
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                @if ($this->verificaPresenca($aluno->user_id))
                                    <div class="d-flex flex-column">
                                        <div class="mb-2">
                                            <input class="form-check-input" wire:click='registraAtraso' checked
                                                name="" type="checkbox" id="{{ $i }}" disabled>
                                            <label class="form-check-label" for="{{ $i }}"
                                                wire:click='registraAtraso'>
                                                @if ($this->verificaPresenca($aluno->user_id)->atraso == false)
                                                    Presença
                                                @else
                                                    Atraso
                                                @endif
                                            </label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="form-check-input" name=""
                                                @if ($this->verificaPresenca($aluno->user_id)->material == true) checked @endif type="checkbox"
                                                disabled id="material_didatico" required>
                                            <label class="form-check-label" for="material_didatico">
                                                Material Didático
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex flex-column">
                                        <div class="mb-2">
                                            <input class="form-check-input" wire:change='registraAtraso' name="atraso"
                                                type="checkbox" id="{{ 'presenca' . $i }}">
                                            <label class="form-check-label" for="{{ 'presenca' . $i }}">
                                                Atraso
                                            </label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" wire:change='registraMaterial'
                                                name="material" checked type="checkbox" id="{{ 'material' . $i }}">
                                            <label class="form-check-label" for="{{ 'material' . $i }}">
                                                Material Didático
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                @if (!$this->verificaPresenca($aluno->user_id))
                                    <button wire:click.prevent="store({{ $aluno->user_id }} )"
                                        class="btn btn-primary btn-sm mr-3" alt="Presença"><i
                                            class="fas fa-stopwatch"></i>
                                        Registrar presença</button>
                                @elseif ($this->verificaPresenca($aluno->user_id))
                                    <a wire:click='destroy("{{ $aluno->user_id }}")' class="btn btn-danger btn-sm mr-3"
                                        alt="Excluir"><i class="fa fa-eraser" aria-hidden="true"></i> Deletar presença
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center">

                            <h2>Não existem alunos associados a essa turma!</h2>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $alunos->links() }}
    </div>
</div>
