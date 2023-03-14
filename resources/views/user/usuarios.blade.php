<x-app-layout>

    @section('cabecalho')
        Usuários
    @endsection

    @include('components.flash-message')
    <div class="table-responsive">
        <table class="table" id="datatablesSimple">
            <thead>
                <tr>
                    <th scope="col">Matricula</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Igreja</th>
                    @if (Auth::user()->perfil_id == App\Models\Perfil::ADMINISTRADOR ||
                            Auth::user()->perfil_id == App\Models\Perfil::SUPERINTENDENTE)
                        <th scope="col">Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <th scope="row">{{ $usuario->id }}</th>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ date('d/m/Y', strtotime($usuario->data_nascimento)) }}</td>
                        <td>{{ $perfil->find($usuario->perfil_id)->perfil }} </td>
                        <td>{{ App\Models\User::getIgrejaName($usuario->id) }}</td>
                        @if (Auth::user()->perfil_id == App\Models\Perfil::ADMINISTRADOR ||
                                Auth::user()->perfil_id == App\Models\Perfil::SUPERINTENDENTE)
                            <td>
                                <span class="d-flex justify-content-around">
                                    <a href="/user/usuario/{{ $usuario->id }}/editar" class="btn btn-primary"><i
                                            class="fas fa-edit"></i> </a>

                                    <form action="{{ route('delete.user', ['id' => $usuario->id]) }}" method="post"
                                        onsubmit="return confirm('Tem certeza? Todos os registros serão apagados e não poderão ser recuperados.')">
                                        @csrf
                                        @method('DELETE')
                                        {{-- <input type="hidden" name="turma_id" value="{{ $turma->id }}"> --}}
                                        <button class="btn btn-danger" alt="Excluir"><i class="fa fa-eraser"
                                                aria-hidden="true"></i></button>
                                    </form>
                                </span>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
