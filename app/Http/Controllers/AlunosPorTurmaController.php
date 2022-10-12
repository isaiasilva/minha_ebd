<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunosPorTurmaController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var AlunoPorTurma
     */
    private $alunoPorTurma;
    /**
     * @var Turma
     */
    private $turma;
    /**
     * @var ProfessorPorTurma
     */
    private $professorPorTurma;

    public function __construct(User $user, AlunoPorTurma $alunoPorTurma, Turma $turma, ProfessorPorTurma $professorPorTurma)
    {
        $this->user = $user;
        $this->alunoPorTurma = $alunoPorTurma;
        $this->turma = $turma;
        $this->professorPorTurma = $professorPorTurma;
    }

    public function index()
    {
        $alunosPorTurma  = $this->alunoPorTurma::all();
        $usuario = $this->user;
        $turma = $this->turma;

        return view('user.aluno-por-turma', ['turma' => $turma, 'usuario' => $usuario, 'title' => 'Alunos Por Turma', 'alunosPorTurma' => $alunosPorTurma]);
    }

    public function create()
    {
        $turmas = $this->turma->all();
        $alunos = $this->user->all();

        if (Auth::user()->perfil_id === 3) {
            $repositorioTurmas = $this->professorPorTurma->where('professor_id', Auth::user()->id)->get();
            $turmas = [];

            foreach ($repositorioTurmas as $turma) {
                $i = [
                    'id' => $turma->turma_id,
                    'nome_turma' => $this->turma->find($turma->turma_id)->nome_turma
                ];
                array_push($turmas, (object)$i);
            }
        }


        return view('user.novo-aluno-por-turma', ['turmas' => $turmas, 'alunos' => $alunos, 'title' => 'Aluno por turma']);
    }

    public function store(Request $request)
    {
        $alunoPorTurma = $this->alunoPorTurma;
        if (count($alunoPorTurma->where([
            'user_id' => $request->aluno,
            'turma_id' => $request->turma
        ])->get()) == 1) {
            return redirect()->back()->withErrors('Aluno já associado nessa turma!');
        }

        $alunoPorTurma->create([
            'user_id' => $request->aluno,
            'turma_id' => $request->turma
        ]);

        return redirect()->back()->with('success', 'Aluno associado com sucesso!');
    }

    public function destroy(Request $request)
    {
        try {
            $turma = $request->turma_id;
            $aluno = $request->aluno_id;

            $alunoPorTurma = $this->alunoPorTurma->where(['user_id' => $aluno, 'turma_id' => $turma])->get()->first();

            $alunoPorTurma->delete();

            return redirect()->back()->with('success', 'Aluno desassociado com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro ao tentar desassociar aluno');
        }
    }
}
