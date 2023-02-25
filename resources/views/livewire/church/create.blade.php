<div>
    @section('cabecalho')
        Nova Igreja
    @endsection
    <form wire:submit.prevent='store'>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Nome</label>
                    <input type="text" name="name" id="name" wire:model='name' class="form-control">
                </div>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary mt-3">
                    Cadastrar
                </button>
            </div>
        </div>
    </form>
</div>
