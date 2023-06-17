<?php

namespace App\Http\Livewire\User;

use App\Models\{Perfil, User, UsuariosPorIgreja};
use Illuminate\Support\Facades\Auth;

use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perpage = 5;

    public string $search = '';

    public function render()
    {
        if (Auth::user()->perfil_id == Perfil::ADMINISTRADOR) {
            $usuarios = UsuariosPorIgreja::join('users', 'usuarios_por_igrejas.user_id', '=', 'users.id')
                ->join('perfils', 'users.perfil_id', '=', 'perfils.id')
                ->orderBy('users.name', 'ASC')
                ->where('users.name', 'LIKE', '%' . $this->search . '%')
                ->paginate($this->perpage);
        } else {
            $usuarios = UsuariosPorIgreja::where('igreja_id', auth()->user()->getIgreja()->id)
                ->join('users', 'usuarios_por_igrejas.user_id', '=', 'users.id')
                ->join('perfils', 'users.perfil_id', '=', 'perfils.id')
                ->orderBy('users.name', 'ASC')
                ->where('users.name', 'LIKE', '%' . $this->search . '%')
                ->paginate($this->perpage);
        }

        return view('livewire.user.index', ['usuarios' => $usuarios]);
    }
}