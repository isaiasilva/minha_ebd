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
    private Chamada $chamada;

    private AlunoPorTurma $alunoPorTurma;

    public function __construct(Chamada $chamada, AlunoPorTurma $alunoPorTurma)
    {
        $this->chamada = $chamada;
        $this->alunoPorTurma = $alunoPorTurma;
    }

    public function index()
    {

        return view('user.home', [
            'turmas' => AlunoPorTurma::where('user_id', Auth::user()->id)->get(),
            'presencas' => $this->chamada->where(['aluno_id' => Auth::user()->id])->whereYear('data', date('Y'))->count(),
            'jan' => $this->chamada->whereMonth('data', '01')->whereYear('data', date('Y'))->count(),
            'fev' => $this->chamada->whereMonth('data', '02')->whereYear('data', date('Y'))->count(),
            'mar' => $this->chamada->whereMonth('data', '03')->whereYear('data', date('Y'))->count(),
            'abr' => $this->chamada->whereMonth('data', '04')->whereYear('data', date('Y'))->count(),
            'mai' => $this->chamada->whereMonth('data', '05')->whereYear('data', date('Y'))->count(),
            'jun' => $this->chamada->whereMonth('data', '06')->whereYear('data', date('Y'))->count(),
            'jul' => $this->chamada->whereMonth('data', '07')->whereYear('data', date('Y'))->count(),
            'ago' => $this->chamada->whereMonth('data', '08')->whereYear('data', date('Y'))->count(),
            'set' => $this->chamada->whereMonth('data', '09')->whereYear('data', date('Y'))->count(),
            'out' => $this->chamada->whereMonth('data', '10')->whereYear('data', date('Y'))->count(),
            'nov' => $this->chamada->whereMonth('data', '11')->whereYear('data', date('Y'))->count(),
            'dez' => $this->chamada->whereMonth('data', '12')->whereYear('data', date('Y'))->count(),
            'adolescentes' => $this->alunoPorTurma->where('turma_id', 1)->count(),
            'adultos' => $this->alunoPorTurma->where('turma_id', 2)->count(),
            'discipulado' => $this->alunoPorTurma->where('turma_id', 3)->count(),
            'jInfancia' => $this->alunoPorTurma->where('turma_id', 4)->count(),
            'jovens' => $this->alunoPorTurma->where('turma_id', 5)->count(),
            'juniores' => $this->alunoPorTurma->where('turma_id', 6)->count(),
            'primarios' => $this->alunoPorTurma->where('turma_id', 14)->count(),
            'title' => 'Dashboard'
        ]);
    }
}
