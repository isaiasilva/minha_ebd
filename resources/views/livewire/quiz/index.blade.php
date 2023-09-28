<div>
    <div class="row">
        <div class=" col-md-6 col-12 mb-2">
            <div class="d-flex justify-content-between align-items-center">
                @section('cabecalho')
                    Quizzes
                @endsection
                @can('post_material')
                    @section('botao')
                        <a href="{{ route('quiz.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Novo
                        </a>
                    @endsection
                @endcan
            </div>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('principal') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('quiz.index') }}">Quizzes</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="row d-md-flex justify-content-between align-items-center">

        <div class="col-12 col-sm-6 mt-2 mt-md-0">
            <input class="form-control" type="text" placeholder="Filtre" wire:model.live='search'>
        </div>
        <div class="col-12 col-md-6 text-right">
            <label for='perpage' class="ps-3">Registros por página</label>
            <select id='perpage' wire:model.live="perpage" class="form-select my-3">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
        </div>
    </section>
    @foreach ($quizzes as $quiz)
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <span>
                    <h5>
                        <b>
                            <a href="#">{{ $quiz->title }}</a> - {{ $quiz->type }}
                        </b>
                    </h5>
                </span>
                {{-- @can('action_material', $material) --}}
                <div class="btn-group">
                    <button class="btn" type="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="la la-ellipsis-v tamanho-pontos"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Editar</a></li>
                        <li><a class="dropdown-item"
                                onclick="return confirm('Você tem certeza? Essa ação não poderá ser desfeita') ||  event.stopImmediatePropagation()"
                                href="">Excluir</a></li>
                    </ul>
                </div>
                {{--  @endcan --}}
            </div>
        </div>
    @endforeach
    @if (count($quizzes) == 0)
        <p>Não existem quizzes</p>
    @else
        <div class="row d-flex justify-content-around">
            {{ $quizzes->links() }}
        </div>
    @endif
</div>
