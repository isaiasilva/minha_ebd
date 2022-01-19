<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\Perfil;
use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
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

    public function __construct(Turma $turma, User $user, Perfil $perfil, Chamada $chamada, ProfessorPorTurma $professorPorTurma)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
        $this->chamada = $chamada;
        $this->professorPorTurma = $professorPorTurma;
    }

    public function index()
    {
        $turma = $this->turma;
        $turmaAtual = $this->turma->find(Auth::user()->turma_id);

        //$chamada= $this->chamada->where(['turma_id' => Auth::user()->turma_id,'data'=> date('Y-m-d')])->get();
        $chamada= $this->chamada->where(['aluno_id' => Auth::user()->turma_id])->get();

        $presencas = count($chamada);

        $perfil = $this->perfil->find(Auth::user()->perfil_id);

        $turmas = $this->professorPorTurma->where('professor_id', Auth::user()->id)->get();


        $alunos = $this->user->where(['turma_id' => Auth::user()->turma_id, 'perfil_id' => 2])->get();

        return view('user.home', [
            'turma'=> $turma,
            'turmaAtual'=> $turmaAtual,
            'alunos' => $alunos,
            'perfil' => $perfil,
            'presencas' => $presencas,
            'turmas' => $turmas,
            'title' => 'Dashboard'
        ]);
    }
}
