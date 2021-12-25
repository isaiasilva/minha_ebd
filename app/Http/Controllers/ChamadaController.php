<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
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
    public function __construct(User $user, Turma $turma, Chamada $chamada)
    {
        $this->user = $user;
        $this->turma = $turma;
        $this->chamada = $chamada;
    }

    public function index()
    {
        $user = $this->user;
        $turma = $this->turma->find(Auth::user()->turma_id);

        $alunos = $user->where(['turma_id' => Auth::user()->turma_id, 'perfil_id' => 2])->get();
        return view('user.chamada', ['turma'=>$turma, 'alunos' => $alunos]);
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
           return redirect('user/chamada')->with('warning', 'Atraso registrado com sucesso!');;
       }

        return redirect('user/chamada')->with('success', 'Presença registrada com sucesso!');;
    }

    public function destroy(Request $request)
    {
        $data = date('Y-m-d');

        $presenca = $this->chamada->where(['aluno_id' => $request->aluno , 'data' => $data])->get();

        $presenca->first()->delete();

        return redirect('user/chamada')->with('success', 'Presença apagada com sucesso!');
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
}
