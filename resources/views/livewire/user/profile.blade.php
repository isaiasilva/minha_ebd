<div>
    @section('cabecalho')
        Perfil
    @endsection

    <form wire:submit.prevent='update'>

        <input type="hidden" name="id" id="name" value="{{ Auth::user()->id }}" required class="form-control">
        <div class="container">
            <div class="row">
                @if ($photo)
                    <div class="col-md-3">
                        <img src="{{ $photo->temporaryUrl() }}" width="200px" height="200px"
                            class="img-fluid img-thumbnail" style="max-width: 200px;">
                        <p><strong>Aquivo selecionado: </strong> {{ $photo->getClientOriginalName() }} </p>
                    </div>
                @else
                    <div class="col-md-3">
                        <img src="{{ asset(auth()->user()->path_photo) }}" class="img-fluid img-thumbnail"
                            style="max-width: 200px;">
                        <div class="input-group mt-2">
                            <label for="uploadFoto" class="btn btn-outline-secondary">Alterar
                                foto</label>
                            <input type="file" wire:model='photo' hidden class="form-control" id="uploadFoto"
                                aria-label="Upload">

                        </div>
                    </div>
                @endif

                <div class="col-md">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Nome</label>
                                <input type="text" name="name" id="name" value="" wire:model='name'
                                    required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Usuário</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                    wire:model='email' required class="form-control">
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="perfil">Perfil</label>
                        <input type="text" name="perfil" id="perfil" wire:model='profile' value="" readonly
                            required class="form-control">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select class="form-control" name="estado_civil" wire:model='maritalStatus' required>
                            <option value="Solteiro(a)">Solteiro(a)</option>
                            <option value="Casado(a)">Casado(a)</option>
                            <option value="Viuvo(a)">Viuvo(a)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" value=""
                            wire:model='date' required class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone">Telefone (Watsapp)</label>
                        <input type="tel" name="telefone" id="telefone" class="form-control" value=""
                            wire:model='phone'>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <button type="submit" class="btn btn-primary mt-3">
                        Atualizar
                    </button>
                </div>
            </div>

        </div> <!-- Final do container -->
    </form>
</div>
