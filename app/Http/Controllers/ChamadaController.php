<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
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
    /**
     * @var AlunoPorTurma
     */
    private $alunoPorTurma;

    public function __construct(
        User $user, Turma $turma,
        Chamada $chamada,
        ProfessorPorTurma $professorPorTurma,
        AlunoPorTurma $alunoPorTurma
    )
    {
        $this->user = $user;
        $this->turma = $turma;
        $this->chamada = $chamada;
        $this->professorPorTurma = $professorPorTurma;
        $this->alunoPorTurma = $alunoPorTurma;
    }

    public function index(Request $request)
    {
        $users = $this->user;
        $user = $this->alunoPorTurma;
        $turmas = $this->turma;
        $minhasTurmas = $this->professorPorTurma->where(['professor_id' => Auth::user()->id])->get();

        $verificaTurma = $this->verificaTurmaAtual();

        if (is_null($verificaTurma)){
            return redirect('/user/home')->with('warning','Professor não foi associado em nenhuma turma');
        }
        $turmaAtual = $verificaTurma->turma_id;
        $nomeTurma = $this->turma->find($turmaAtual)->nome_turma;
        $alunos = $user->where(['turma_id' => $turmaAtual])->get();



        if(isset($request->id)){
            $turmaAtual = $request->id;
            $nomeTurma = $this->turma->find($turmaAtual)->nome_turma;
            $alunos = $user->where(['turma_id' => $turmaAtual])->get();
        }

        $repositorioAlunos = [];
        foreach ($alunos as $i => $aluno){

            $i = [
                'aluno_id' => $aluno->aluno_id,
                'nome' => $users->find($aluno->aluno_id)->name,
                'turmaAtual'=> $turmaAtual,
                'nomeTurma' => $nomeTurma,
                'material' =>  $this->verificaMaterial($aluno->aluno_id, $turmaAtual),
                'presenca' =>  $this->verificaPresenca($aluno->aluno_id, $turmaAtual),

                ];

            array_push($repositorioAlunos, (object)$i);

        }

        //dd($repositorioAlunos);

        return view('user.chamada', [
            'minhasTurmas'=> $minhasTurmas,
            'turmaAtual'=>$turmaAtual,
            'turmas'=>$turmas,
            'alunos' => $repositorioAlunos,
            'nomeTurma' => $nomeTurma,
            'users' => $users
        ]);
    }

    public function create(Request $request)
    {
       $data = date('Y-m-d') ;
        $atraso = "false";
        $material = "false";

       if(self::verificaPresenca($request->aluno, $request->turma) === true){
           return redirect()
               ->back()
               ->withErrors('Aluno já marcado como presente');
       }

       if($request->atraso){
           $atraso = "true";
       }

        if($request->material){
            $material = "true";
        }


       $chamada =  $this->chamada->create([
           'data' => $data,
           'professor_id' => (int)$request->professor,
           'turma_id' => (int)$request->turma,
           'aluno_id' => (int)$request->aluno,
           'atraso' => $atraso,
           'material' => $material,
       ]);

       if($atraso === "true"){
           return redirect()->back()->with('warning', 'Atraso registrado com sucesso!');
       }

        return redirect()->back()->with('success', 'Presença registrada com sucesso!');
    }

    public function destroy(Request $request)
    {
       $data = date('Y-m-d') ;

       $presenca = $this->chamada->where(['aluno_id' => $request->aluno  , 'turma_id' => $request->turma, 'data' => $data])->get();

       $presenca->first()->delete();

        return redirect()->back()->with('success', 'Presença apagada com sucesso!');
    }

    private function verificaMaterial($aluno, $turma){
        $data = date('Y-m-d');

        $presenca = Chamada::where( ['aluno_id' => $aluno, 'turma_id' => $turma , 'data' => $data] )->get();
        $retorno = "no-checked";
        foreach ($presenca as $chamada){
            if ($chamada->id && $chamada->material === "true"){
                $retorno = "checked";
            }
        }
        return $retorno;
    }

    private function verificaPresenca($aluno, $turma)
    {
        $data = date('Y-m-d');


        $presenca = Chamada::where( ['aluno_id' => $aluno, 'turma_id' => $turma , 'data' => $data] )->get();

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
            $turmaAtual = $this->user->find(Auth::user()->id);
        }

        if (Auth::user()->perfil_id == "3"){
            $turmaAtual = $this->professorPorTurma
                ->where(['professor_id' => Auth::user()->id])
                ->get()
                ->first();

        }
       /*
        if (is_null($turmaAtual)){
            return redirect('/user/home')->with('warning','Professor não foi associado em nenhuma turma');
        } */

        return $turmaAtual;
    }
}
