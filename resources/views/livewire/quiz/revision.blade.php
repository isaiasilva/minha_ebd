<div>

    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            @section('cabecalho')
                {{ $quiz->title }}
            @endsection

            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('principal') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item "><a href="{{ route('quiz.index') }}">Quizzes</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="#">{{ $quiz->title }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @foreach ($questions as $i => $question)
        <div class="card" wire:key="{{ $question->id }}">
            <div class="card-header">
                <h3>Questão </h3>
                {!! $question->body !!}
            </div>
            <div class="card-body">
                <p><strong>Alternativas:</strong></p>
                @forelse ($question->items as $key => $item)
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="item" id="item{{ $key }}"
                                value="option2">
                            <label class="form-check-label d-flex" for="item{{ $key }}">
                                <strong class="mr-1">{{ alternatives($key) }}</strong> {!! $item->body !!}
                            </label>
                        </div>
                    </div>
                @empty
                    <p>Não existem itens cadastradas.</p>
                @endforelse
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $questions->links() }}
    </div>
</div>
