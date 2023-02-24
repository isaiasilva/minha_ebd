<x-app-layout>

    @section('cabecalho')
        Registrar Turma
    @endsection

    @include('components.flash-message')
    <form method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome_turma" id="nome" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary mt-3">
                        Registrar
                    </button>
                </div>
            </div>
        </div><!-- FIM DO CONTAINER -->
    </form>
</x-app-layout>
