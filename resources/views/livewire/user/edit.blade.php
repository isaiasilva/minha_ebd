<div>
    @section('cabecalho')
        Editar Usuário
    @endsection

    <form wire:submit.prevent='update()'>

        <div class="container">
            <div class="row">
                @if ($photo)
                    <div class="col-md-3">
                        <img src="{{ $photo->temporaryUrl() }}" width="200px" height="200px"
                            class="img-fluid img-thumbnail" style="max-width: 200px;">
                        <p><strong>Aquivo selecionado: </strong> {{ $photo->getClientOriginalName() }} </p>
                        @error('photo')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                @else
                    <div class="col-md-3">
                        <img src="{{ asset($path_photo) }}" class="img-fluid img-thumbnail" style="max-width: 200px;">
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
                                    class="form-control">
                            </div>
                            @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Usuário</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                    wire:model='email' class="form-control">
                            </div>
                            @error('email')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="perfil">Perfil</label>
                        <select class="form-control" wire:model="profile" aria-label="Default select example" required>
                            <option selected value="">Selecione</option>

                            @foreach ($profiles as $perfil)
                                <option value="{{ $perfil->id }}">
                                    {{ $perfil->perfil }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('profile')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado_civil">Estado Civil</label>
                        <select class="form-control" name="estado_civil" wire:model='maritalStatus'>
                            <option value="Solteiro(a)">Solteiro(a)</option>
                            <option value="Casado(a)">Casado(a)</option>
                            <option value="Viuvo(a)">Viuvo(a)</option>
                        </select>
                    </div>
                </div>
                @error('maritalStatus')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" value=""
                            wire:model='date' class="form-control">
                    </div>
                    @error('date')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefone">Telefone (Watsapp)</label>
                        <input type="tel" name="telefone" id="telefone" class="form-control" value=""
                            wire:model='phone'>
                    </div>
                    @error('pone')
                        <p class="error">{{ $message }}</p>
                    @enderror
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
