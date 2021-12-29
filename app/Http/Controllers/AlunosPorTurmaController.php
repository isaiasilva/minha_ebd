<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function __construct(User $user, AlunoPorTurma $alunoPorTurma, Turma $turma)
    {
        $this->user = $user;
        $this->alunoPorTurma = $alunoPorTurma;
        $this->turma = $turma;
    }

    public function index()
    {
        $alunoPorTurma  = $this->alunoPorTurma::all();
        $usuario = $this->user;
        $turma = $this->turma;

        return view('user.aluno-por-turma', ['turma'=>$turma, 'usuario' => $usuario, 'alunoPorTurma' => $alunoPorTurma]);
    }

    public function create()
    {
        $turmas = $this->turma->all();
        $alunos = $this->user->all();

        return view('user.novo-aluno-por-turma', ['turmas' => $turmas, 'alunos' => $alunos ]);
    }

    public function store(Request $request)
    {
        $alunoPorTurma = $this->alunoPorTurma;
        if(count($alunoPorTurma->where([
                'aluno_id' => $request->aluno,
                'turma_id' => $request->turma
            ])->get()) == 1)
        {
            return redirect()->back()->withErrors('Aluno já associado nessa turma!');
        }

        $alunoPorTurma->create([
            'aluno_id' => $request->aluno,
            'turma_id' => $request->turma
        ]);

        return redirect()->back()->with('success','Aluno associado com sucesso!');
    }

    public function destroy(Request $request)
    {
         $turma = $request->turma_id;
         $aluno = $request->aluno_id;

        $alunoPorTurma = $this->alunoPorTurma->where(['aluno_id' => $aluno, 'turma_id' => $turma])->get()->first();

        $alunoPorTurma->delete();

        return redirect()->back()->with('success', 'Aluno desassociado com sucesso!');
    }
}
