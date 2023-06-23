<div>
    @section('cabecalho')
        Alunos por turma
    @endsection


    <form wire:submit.prevent='renderPdf'>

        <label for="igreja_id">Igreja</label>
        <select class="form-control mb-1" id="igreja_id" name="igreja" wire:model='igreja_id' wire:change='recuperaTurmas'>
            <option selected value="">Selecione</option>
            @foreach ($igrejas as $igreja)
                <option value="{{ $igreja->id }}">{{ $igreja->nome }}</option>
            @endforeach
        </select>
        @error('igreja_id')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="turma_id">Turma</label>
        <select class="form-control" id='turma_id' name="turma" wire:model='turma_id'>
            <option selected value="">Selecione</option>
            @foreach ($turmas as $turma)
                <option value="{{ $turma->id }}">{{ $turma->nome_turma }}</option>
            @endforeach
        </select>
        @error('turma_id')
            <div class="error">{{ $message }}</div>
        @enderror
        <button class="btn btn-primary mt-1">Gerar relatório</button>
    </form>


</div>
