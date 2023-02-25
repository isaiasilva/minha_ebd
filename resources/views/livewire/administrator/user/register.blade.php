<div class="container">
    <style>
        p {
            color: red;
            font-weight: 500;
        }
    </style>
    <h2 class="display-4 titulo">Registrar Usuário</h2>
    <form wire:submit.prevent='store'>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Nome</label>
                    <input type="text" name="name" id="name" wire:model='name' class="form-control">
                </div>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Acesso</label>
                    <input type="email" name="email" id="email" wire:model='email' class="form-control"
                        placeholder="exemplo: nome_aluno@aluno">
                </div>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-control" name="estado_civil" wire:model='maritalStatus'>
                        <option selected value="">Selecione</option>
                        <option value="Solteiro(a)">Solteiro(a)</option>
                        <option value="Casado(a)">Casado(a)</option>
                        <option value="Viuvo(a)">Viuvo(a)</option>
                    </select>
                </div>
                @error('maritalStatus')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md">
                <div class="form-group">
                    <label for="estado_civil">Igreja</label>
                    <select class="form-control" name="estado_civil" wire:model='church'>
                        <option selected value="">Selecione</option>
                        @foreach ($churchs as $church)
                            <option value="{{ $church->id }}">{{ $church->nome }}</option>
                        @endforeach

                    </select>
                    @error('church')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                @error('maritalStatus')
                    <p>{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" wire:model='birthDate'
                        class="form-control">
                </div>
                @error('birthDate')
                    <p>{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Telefone</label>
                    <input type="text" wire:model='phone' min="6" class="form-control">
                </div>
                @error('phone')
                    <p>{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado_civil">Perfil</label>
                    <select class="form-control" name="perfil" wire:model='perfil'>
                        <option selected value="">Selecione</option>
                        @foreach ($profiles as $profile)
                            <option value="{{ $profile->id }}">
                                {{ $profile->perfil }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary mt-3">
                    Registrar
                </button>
            </div>
        </div>
    </form>
</div>
