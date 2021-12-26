<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\Perfil;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    /**
     * @var Turma
     */
    private $turma;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Perfil
     */
    private $perfil;
    /**
     * @var Chamada
     */
    private $chamada;

    public function __construct(Turma $turma, User $user, Perfil $perfil, Chamada $chamada)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
        $this->chamada = $chamada;
    }

    public function index()
    {
        $turma = $this->turma->find(Auth::user()->turma_id);
        $perfil = $this->perfil;
        $usuarios = $this->user->all();
        return view('user.usuarios', ['turma'=>$turma, 'usuarios' => $usuarios, 'perfil' => $perfil]);
    }

    public function destroy($id)
    {
        $usuario = $this->user->find($id);

        $chamadas = $this->chamada->where('aluno_id',$usuario->id)->get();

        // ecluindo presenças registradas
        foreach ($chamadas as $chamada){
            $chamada->delete();
        }

        $usuario->delete();
        return redirect()->back()->with('success', 'Usuário excluido com sucesso.');

    }
}
