<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\DateTime;

class ChamadaController extends Controller
{
    private $user;
    private $turma;
    private $chamada;
    /**
     * @var ProfessorPorTurma
     */
    private $professorPorTurma;

    public function __construct(User $user, Turma $turma, Chamada $chamada, ProfessorPorTurma $professorPorTurma)
    {
        $this->user = $user;
        $this->turma = $turma;
        $this->chamada = $chamada;
        $this->professorPorTurma = $professorPorTurma;
    }

    public function index(Request $request)
    {
        $user = $this->user;
        $turmas = $this->turma;
        $minhasTurmas = $this->professorPorTurma->where(['professor_id' => Auth::user()->id])->get();

        $turmaAtual = $this->verificaTurmaAtual();

        if(isset($request->id)){
            $turmaAtual = $request->id;
        }

        $nomeTurma = $this->turma->find($turmaAtual)->nome_turma;

        $alunos = $user->where(['turma_id' => $turmaAtual, 'perfil_id' => 2])->get();

        return view('user.chamada', [
            'minhasTurmas'=> $minhasTurmas,
            'turmaAtual'=>$turmaAtual,
            'turmas'=>$turmas,
            'alunos' => $alunos,
            'nomeTurma' => $nomeTurma
        ]);
    }

    public function create(Request $request)
    {
       $data = date('Y-m-d') ;
       if(self::verificaPresenca($request->aluno) === true){
           return redirect()
               ->back()
               ->withErrors('Aluno já marcado como presente');
       }


       $chamada =  $this->chamada->create([
           'data' => $data,
           'professor_id' => (int)$request->professor,
           'turma_id' => (int)$request->turma,
           'aluno_id' => (int)$request->aluno,
           'atraso' => $request->atraso
       ]);

       if($request->atraso === "true"){
           return redirect()->back()->with('warning', 'Atraso registrado com sucesso!');;
       }

        return redirect()->back()->with('success', 'Presença registrada com sucesso!');;
    }

    public function destroy(Request $request)
    {
        $data = date('Y-m-d');

        $presenca = $this->chamada->where(['aluno_id' => $request->aluno , 'data' => $data])->get();

        $presenca->first()->delete();

        return redirect()->back()->with('success', 'Presença apagada com sucesso!');
    }

    static function verificaPresenca($aluno)
    {
        $data = date('Y-m-d');
        $presenca = Chamada::where( ['aluno_id' => $aluno, 'data' => $data] )->get();

        $retorno = "Pendente";
        foreach ($presenca as $chamada){
            if($chamada->id && $chamada->atraso == "true"){
                $retorno = "Atraso";
            }else if($chamada->id && $chamada->atraso == "false"){
                $retorno = "Presença";
            }
        }

        return $retorno;
    }

    /**
     * @param User $user
     * @return mixed
     */
    protected function verificaTurmaAtual()
    {
        if (Auth::user()->perfil_id == "1") {
            $turmaAtual = $this->user->find(Auth::user()->id)->turma_id;
        }

        if (Auth::user()->perfil_id == "3"){
            $turmaAtual = $this->professorPorTurma
                ->where(['professor_id' => Auth::user()->id])
                ->get()
                ->first()->turma_id;
        }
        return $turmaAtual;
    }
}
