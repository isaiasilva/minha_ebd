<div>
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">

            @section('cabecalho')
                {{ $material->titulo }}
            @endsection

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
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Detalhes do material</h3>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-plus"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Arquivo</a>
                    <a class="dropdown-item" href="#">Link </a>
                    <a class="dropdown-item" href="#">YouTube</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p><b>Titulo:</b> {{ $material->titulo }}</p>
            <p><b>Descricao:</b> {{ $material->descricao }}</p>
            <p><b>Data de publicação:</b> {{ date('d/m/Y H:i:s', strtotime($material->publicar_em)) }}</p>
        </div>

    </div>
</div>
