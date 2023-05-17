<div>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <div class="d-flex justify-content-between align-items-center">
                @section('cabecalho')
                    Material de Apoio
                @endsection
                @section('botao')
                    <a href="{{ route('material.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Novo
                    </a>
                @endsection
            </div>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('principal') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('material.index') }}">Materiais</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    @forelse ($materials as $material)
        {{ $material->titulo }}
    @empty
        <p>Não existem materiais</p>
    @endforelse
</div>
