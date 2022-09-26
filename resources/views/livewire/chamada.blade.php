<div>
    @include('components.flash-message')
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
                @foreach ($alunos as $i => $aluno)
                    <tr>
                        <td>{{ $aluno->name }}</td>
                        <td>
                            <div class="form-check">
                                @if ($aluno->presenca)
                                    <div class="d-flex flex-column">
                                        <div class="mb-2">
                                            <input class="form-check-input" wire:click='registraAtraso' checked
                                                name="" type="checkbox" id="{{ $i }}" disabled>
                                            <label class="form-check-label" for="{{ $i }}"
                                                wire:click='registraAtraso'>
                                                @if ($aluno->presenca->atraso == false)
                                                    Presença
                                                @else
                                                    Atraso
                                                @endif
                                            </label>
                                        </div>
                                        <div class="mb-2">
                                            <input class="form-check-input" name=""
                                                @if ($aluno->presenca->material == true) checked @endif type="checkbox"
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

                                <button wire:click.prevent="store({{ $aluno->id }} )"
                                    class="btn btn-primary btn-sm mr-3" alt="Presença"
                                    @if ($aluno->presenca) disabled @endif><i class="fas fa-stopwatch"></i>
                                    Registrar</button>
                                @if (!$aluno->presenca)
                                    <button alt="Excluir" class="btn btn-danger btn-sm mr-3" disabled>
                                        <i class="fa fa-eraser" aria-hidden="true"></i> Deletar
                                    </button>
                                @else
                                    <a wire:click='destroy("{{ $aluno->id }}")' class="btn btn-danger btn-sm mr-3"
                                        alt="Excluir"><i class="fa fa-eraser" aria-hidden="true"></i> Deletar</a>
                                @endif
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
