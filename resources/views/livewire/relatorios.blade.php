<div>
    @section('cabecalho')
        Alunos por turma
    @endsection


    <form action="{{ route('alunos-por-turma') }}" method="POST">
        @csrf
        <label for="igreja_id">Igreja</label>
        <select class="form-control mb-1" id="igreja_id" name="igreja" wire:model='igreja_id' wire:change='recuperaTurmas'
            required>
            <option selected value="">Selecione</option>
            @foreach ($igrejas as $igreja)
                <option value="{{ $igreja->id }}">{{ $igreja->nome }}</option>
            @endforeach
        </select>
        <label for="turma_id">Turma</label>
        <select class="form-control" id='turma_id' name="turma" wire:model='turma_id' required>
            <option selected value="">Selecione</option>
            @foreach ($turmas as $turma)
                <option value="{{ $turma->id }}">{{ $turma->nome_turma }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary mt-1">Gerar relatório</button>
    </form>


</div>
