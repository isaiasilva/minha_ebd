<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            @section('cabecalho')
                Novo material
            @endsection
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('principal') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('material.index') }}">Materiais</a>
                        </li>
                        <li class="breadcrumb-item active"> <a href="{{ route('material.index') }}">Novo Material</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form-center">Criar novo material de apoio</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form class="form" wire:submit.prevent='store'>
                            <div class="row ">
                                <div class="col">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="titulo">Título</label>
                                            <input type="text" id="titulo" wire:model='fields.titulo'
                                                class="form-control" placeholder="" name="">
                                            @error('fields.titulo')
                                                <p class="error">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div class="form-group ">
                                            <label for="descricao">Descrição</label>
                                            <input type="text" id="descricao" wire:model='fields.descricao'
                                                class="form-control" placeholder="" name="">
                                            @error('fields.descricao')
                                                <p class="error">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group ">
                                            <label for="data_publicacao">Data da publicação</label>
                                            <input type="datetime-local" id="data_publicacao" class="form-control"
                                                wire:model='fields.publicar_em' name="">
                                            @error('fields.publicar_em')
                                                <p class="error">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="row ">
                                            <div class="col-12 col-lg-2">
                                                <div class="form-group">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            wire:click='changeGlobalPublish'
                                                            id="flexSwitchCheckDefault">
                                                        <label for="flexSwitchCheckDefault" class="fs-5 text">Publicação
                                                            global?</label>

                                                    </div>

                                                </div>
                                            </div>
                                            <span class="small">Publicações globais serão visiveis para todas
                                                as
                                                igrejas.</span>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">

                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
