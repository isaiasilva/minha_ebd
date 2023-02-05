<div>
    @section('cabecalho')
        Alunos por turma
    @endsection

    @section('conteudo')
        <form action="{{ route('alunos-por-turma') }}" method="POST">
            @csrf
            <select class="form-control" name="turma" wire:model='turma_id' required>
                <option selected value="">Selecione</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->nome_turma }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary mt-3">Gerar relatório</button>
        </form>
    @endsection

</div>
