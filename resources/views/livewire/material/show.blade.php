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
</div>
