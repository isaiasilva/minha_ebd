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
    public function index()
    {
        $turma = Turma::find(Auth::user()->turma_id);
        $alunos = User::where(['turma_id' => Auth::user()->turma_id, 'perfil' => 'ALUNO'])->get();
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

       $chamada =  Chamada::create([
           'data' => $data,
           'professor_id' => (int)$request->professor,
           'turma_id' => (int)$request->turma,
           'aluno_id' => (int)$request->aluno
       ]);

        return redirect('user/chamada')->with('success', 'Presença registrada com sucesso!');;
    }

    public function destroy(Request $request)
    {
        $data = date('Y-m-d');

        $presenca = Chamada::where(['aluno_id' => $request->aluno , 'data' => $data])->get();


        $presenca->first()->delete();

        return redirect('user/chamada')->with('success', 'Presença apagada com sucesso!');
    }

    static function verificaPresenca($aluno)
    {
        $data = date('Y-m-d');
        $presenca = Chamada::where( ['aluno_id' => $aluno, 'data' => $data] )->get();

        $retorno = false;
        foreach ($presenca as $chamada){
            if($chamada->id){
                $retorno = true;
            }
        }
        if($retorno === true){
            return true;
        }
        return $retorno;
    }
}
