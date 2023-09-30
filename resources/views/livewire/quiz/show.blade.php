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
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Detalhes do Quiz</h3>
            {{-- @can('action_material', $material) --}}
            <a href="{{ route('question.create', $quiz) }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
            </a>
            {{--  @endcan --}}
        </div>
        <div class="card-body">

            <p><b>Titulo:</b> {{ $quiz->title }}</p>
            <p><b>Titulo:</b> {{ $quiz->type }}</p>
            <p><b>Status:</b>
                @if ($quiz->is_draft)
                    Rascunho
                @else
                    Ativo
                @endif
            </p>
            {{--  <p><b>Data de publicação:</b> {{ date('d/m/Y H:i:s', strtotime($material->publicar_em)) }}</p> --}}
        </div>

    </div>
    <section>

        @foreach ($quiz->questions as $key => $question)
            <div class="card">
                <div class="card-header d-flex justify-content-between align-content-center">
                    <h4>Questão {{ $key + 1 }} </h4>
                    {{-- @can('action_material', $material) --}}
                    <a href="#" class="btn btn-danger"
                        onclick="return confirm('Você tem certeza? Essa ação não poderá ser desfeita') ||  event.stopImmediatePropagation()" ">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    {{-- @endcan --}}
                </div>
            </div>
 @endforeach

    </section>

</div>

</div>
