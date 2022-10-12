<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
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

    /**
     * @var AlunoPorTurma
     */
    private $alunoPorTurma;

    public function __construct(Turma $turma, User $user, Perfil $perfil, Chamada $chamada, ProfessorPorTurma $professorPorTurma, AlunoPorTurma $alunoPorTurma)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
        $this->chamada = $chamada;
        $this->professorPorTurma = $professorPorTurma;
        $this->alunoPorTurma = $alunoPorTurma;
    }

    public function index()
    {
        $turma = $this->turma;
        $turmaAtual = $this->turma->find(Auth::user()->turma_id);


        //$chamada= $this->chamada->where(['turma_id' => Auth::user()->turma_id,'data'=> date('Y-m-d')])->get();
        $chamada = $this->chamada->where(['aluno_id' => Auth::user()->turma_id])->get();
        //chamadas de Janeiro
        $jan = $this->chamada->whereMonth('data', '01')->get();
        $fev = $this->chamada->whereMonth('data', '02')->get();
        $mar = $this->chamada->whereMonth('data', '03')->get();
        $abr = $this->chamada->whereMonth('data', '04')->get();
        $mai = $this->chamada->whereMonth('data', '05')->get();
        $jun = $this->chamada->whereMonth('data', '06')->get();
        $jul = $this->chamada->whereMonth('data', '07')->get();
        $ago = $this->chamada->whereMonth('data', '08')->get();
        $set = $this->chamada->whereMonth('data', '09')->get();
        $out = $this->chamada->whereMonth('data', '10')->get();
        $nov = $this->chamada->whereMonth('data', '11')->get();
        $dez = $this->chamada->whereMonth('data', '12')->get();

        //turmas
        $adolescentes = $this->alunoPorTurma->where('turma_id', 1)->get();
        $adultos = $this->alunoPorTurma->where('turma_id', 2)->get();
        $discipulado = $this->alunoPorTurma->where('turma_id', 3)->get();
        $jInfancia = $this->alunoPorTurma->where('turma_id', 4)->get();
        $jovens = $this->alunoPorTurma->where('turma_id', 5)->get();
        $juniores = $this->alunoPorTurma->where('turma_id', 6)->get();
        $primarios = $this->alunoPorTurma->where('turma_id', 14)->get();

        $presencas = count($chamada);

        $perfil = $this->perfil->find(Auth::user()->perfil_id);

        $turmas = $this->professorPorTurma->where('professor_id', Auth::user()->id)->get();


        $alunos = $this->user->where(['turma_id' => Auth::user()->turma_id, 'perfil_id' => 2])->get();

        return view('user.home', [
            'turma' => $turma,
            'turmaAtual' => $turmaAtual,
            'alunos' => $alunos,
            'perfil' => $perfil,
            'presencas' => $presencas,
            'turmas' => $turmas,
            'jan' => count($jan),
            'fev' => count($fev),
            'mar' => count($mar),
            'abr' => count($abr),
            'mai' => count($mai),
            'jun' => count($jun),
            'jul' => count($jul),
            'ago' => count($ago),
            'set' => count($set),
            'out' => count($out),
            'nov' => count($nov),
            'dez' => count($dez),
            'adolescentes' => count($adolescentes),
            'adultos' => count($adultos),
            'discipulado' => count($discipulado),
            'jInfancia' => count($jInfancia),
            'jovens' => count($jovens),
            'juniores' => count($juniores),
            'primarios' => count($primarios),
            'title' => 'Dashboard'
        ]);
    }
}
