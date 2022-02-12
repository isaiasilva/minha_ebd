<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisualizarChamadasController extends Controller
{
    /**
     * @var Chamada
     */
    private $chamada;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Turma
     */
    private $turma;

    public function __construct(Chamada $chamada, User $user, Turma $turma)
    {
        $this->chamada = $chamada;
        $this->user = $user;
        $this->turma = $turma;
    }

    public function create()
    {
        $chamadas = $this->chamada->where('aluno_id', Auth::user()->id)->get();
        $presencas = [];

        foreach ($chamadas as $chamada){
            if($chamada->atraso == true){
              $tipoPresenca = "Atraso";
            }else{
                $tipoPresenca = "Normal";
            }
            $i = [
                'data' => date("d/m/Y", strtotime($chamada->data)),
                'turma' => $this->turma->find($chamada->turma_id)->nome_turma,
                'tipo_presenca' => $tipoPresenca,
                'professor' => $this->user->find($chamada->professor_id)->name
            ];
         array_push($presencas, (object)$i);
        }
        return view('user.presencas',['title'=>'Minhas Presenças', 'chamadas' => $presencas]);
    }

    public function todasChamadas(Request $request)
    {

        $usuarios = $this->user->all();
        $chamadas = $this->chamada->all();
        $atrasos = $this->chamada->where('atraso', true)->get();
        $turmas = $this->turma->all();

        // Número de chamadas por mês

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

        if($request->id){
            $usuarios = $this->user->where('turma_id', $request->id)->get();
            $chamadas = $this->chamada->where('turma_id', $request->id)->get();
            $atrasos = $this->chamada->where('turma_id', $request->id)->where('atraso', true)->get();

            // Número de chamadas por mês

            $jan = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '01')->get();
            $fev = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '02')->get();
            $mar = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '03')->get();
            $abr = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '04')->get();
            $mai = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '05')->get();
            $jun = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '06')->get();
            $jul = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '07')->get();
            $ago = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '08')->get();
            $set = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '09')->get();
            $out = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '10')->get();
            $nov = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '11')->get();
            $dez = $this->chamada->where('turma_id', $request->id)->whereMonth('data', '12')->get();
        }

        $alunos = [];

        foreach ($usuarios as $usuario){
            $presencas = $this->chamada->where('aluno_id', $usuario->id)->get();
            $i = [
                'nome' => $usuario->name,
                'presencas' => count($presencas)
            ];
            array_push($alunos, (object)$i);
        }

        return view('user.chamadas-turmas', [
            'title'=> 'Chamadas Por Turma',
            'alunos'=> $alunos,
            'usuarios' => count($usuarios),
            'presencas' => count($chamadas),
            'atrasos' => count($atrasos),
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
            ]);

    }
}
