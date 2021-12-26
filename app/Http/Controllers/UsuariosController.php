<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\Perfil;
use App\Models\ProfessorPorTurma;
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
    /**
     * @var ProfessorPorTurma
     */
    private $professorPorTurma;

    public function __construct(
        Turma $turma,
        User $user,
        Perfil $perfil,
        Chamada $chamada,
        ProfessorPorTurma $professorPorTurma)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
        $this->chamada = $chamada;
        $this->professorPorTurma = $professorPorTurma;
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

        // se for professor
        if($usuario->perfil_id === "3"){
            $colecaoProfessor = $this->professorPorTurma->where('professor_id',$usuario->id )->get();
            $this->excluirProfessorPorTurma($colecaoProfessor);
        }

        $chamadas = $this->chamada->where('aluno_id',$usuario->id)->get();

        $this->excluirChamada($chamadas);

        $usuario->delete();
        return redirect()->back()->with('success', 'Usuário excluido com sucesso.');
    }

    /**
     * @param $ColecaoProfessor
     */
    protected function excluirProfessorPorTurma($ColecaoProfessor): void
    {
        foreach ($ColecaoProfessor as $professor) {
            $professor->delete();
        }
    }

    /**
     * @param $chamadas
     */
    protected function excluirChamada($chamadas): void
    {
        foreach ($chamadas as $chamada) {
            $chamada->delete();
        }
    }

}
