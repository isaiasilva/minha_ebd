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
    <div class="card">
        <div class="card-header ">
            <h3>Detalhes do Quiz</h3>
        </div>
        <div class="card-body">
            <p><b>Titulo:</b> {{ $quiz->title }}</p>
            <p><b>Titulo:</b> {{ $quiz->type }}</p>
            <p><b>Status:</b>
                @if ($quiz->is_draft)
                    <span class="badge badge-warning">Rascunho</span>
                @else
                    <span class="badge badge-success">Ativo</span>
                @endif
            </p>
            {{--  <p><b>Data de publicação:</b> {{ date('d/m/Y H:i:s', strtotime($material->publicar_em)) }}</p> --}}
        </div>
    </div>
    <section class="d-flex justify-content-between mb-2">
        <h2>Questões</h2>
        <a href="{{ route('question.create', $quiz) }}" class="btn btn-primary"><i class="fas fa-plus"></i> </a>
    </section>
    @forelse ($quiz->questions as $key => $question)
        <div class="card">
            <div class="card-header d-flex justify-content-between align-content-center">
                <h4><a href="{{ route('question.show', ['quiz' => $quiz, 'question' => $question->id]) }}">Questão
                        {{ $key + 1 }} </a></h4>
                <div class="btn-group">
                    <button class="btn" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="la la-ellipsis-v tamanho-pontos"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"
                                href="{{ route('question.edit', ['quiz' => $quiz, 'question' => $question]) }}">Editar</a>
                        </li>
                        <li>
                            <form action="{{ route('quiz.delete', $quiz) }}" method="POST"
                                onsubmit="return confirm('Você tem certeza? Essa ação não poderá ser desfeita')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item">Excluir</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @empty
        <p>Não existem questões cadastradas.</p>
    @endforelse
</div>
