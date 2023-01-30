<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
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
    /**
     * @var AlunoPorTurma
     */
    private $alunoPorTurma;

    public function __construct(Chamada $chamada, User $user, Turma $turma, AlunoPorTurma $alunoPorTurma)
    {
        $this->chamada = $chamada;
        $this->user = $user;
        $this->turma = $turma;
        $this->alunoPorTurma = $alunoPorTurma;
    }

    public function create()
    {
        $chamadas = $this->chamada->where('aluno_id', Auth::user()->id)->get();
        $presencas = [];

        foreach ($chamadas as $chamada) {
            if ($chamada->atraso == true) {
                $tipoPresenca = "Atraso";
            } else {
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
        return view('user.presencas', ['title' => 'Minhas Presenças', 'chamadas' => $presencas]);
    }

    public function todasChamadas(Request $request)
    {
        $usuarios = $this->user->all();
        $alunos = [];

        foreach ($usuarios as $usuario) {
            $presencas = $this->chamada->where('aluno_id', $usuario->id)->whereYear('data', date('Y'))->count();

            if ($request->id) {
                $presencas = $this->chamada->where(['aluno_id' => $usuario->id, 'turma_id' => $request->id])->whereYear('data', date('Y'))->count();
            }

            $i = [
                'nome' => $usuario->name,
                'presencas' => $presencas
            ];
            array_push($alunos, (object)$i);
        }

        return view('user.chamadas-turmas', [
            'title' => 'Chamadas Por Turma',
            'alunos' => $alunos,
            'usuarios' => $this->user->count(),
            'presencas' => $this->chamada->where('atraso', false)->whereYear('data', date('Y'))->count(),
            'atrasos' => $this->chamada->where('atraso', true)->whereYear('data', date('Y'))->count(),
            'turmas' => $this->turma->all(),
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
        ]);
    }

    public function chamadasPorTurma($id)
    {

        $usuarios = $this->alunoPorTurma->where('turma_id', $id)->whereYear('data', date('Y'))->get();
        $chamadas = $this->chamada->where('turma_id', $id)->whereYear('data', date('Y'))->get();
        $atrasos = $this->chamada->where('turma_id', $id)->where('atraso', true)->whereYear('data', date('Y'))->get();
        $turmas = $this->turma->all();
        $nomeTurma = $this->turma->find($id)->nome_turma;

        // Número de chamadas por mês

        $jan = $this->chamada->where('turma_id', $id)->whereMonth('data', '01')->whereYear('data', date('Y'))->get();
        $fev = $this->chamada->where('turma_id', $id)->whereMonth('data', '02')->whereYear('data', date('Y'))->get();
        $mar = $this->chamada->where('turma_id', $id)->whereMonth('data', '03')->whereYear('data', date('Y'))->get();
        $abr = $this->chamada->where('turma_id', $id)->whereMonth('data', '04')->whereYear('data', date('Y'))->get();
        $mai = $this->chamada->where('turma_id', $id)->whereMonth('data', '05')->whereYear('data', date('Y'))->get();
        $jun = $this->chamada->where('turma_id', $id)->whereMonth('data', '06')->whereYear('data', date('Y'))->get();
        $jul = $this->chamada->where('turma_id', $id)->whereMonth('data', '07')->whereYear('data', date('Y'))->get();
        $ago = $this->chamada->where('turma_id', $id)->whereMonth('data', '08')->whereYear('data', date('Y'))->get();
        $set = $this->chamada->where('turma_id', $id)->whereMonth('data', '09')->whereYear('data', date('Y'))->get();
        $out = $this->chamada->where('turma_id', $id)->whereMonth('data', '10')->whereYear('data', date('Y'))->get();
        $nov = $this->chamada->where('turma_id', $id)->whereMonth('data', '11')->whereYear('data', date('Y'))->get();
        $dez = $this->chamada->where('turma_id', $id)->whereMonth('data', '12')->whereYear('data', date('Y'))->get();

        $alunos = [];

        foreach ($usuarios as $usuario) {

            $presencas = $this->chamada->where(['aluno_id' => $usuario->aluno_id, 'turma_id' => $id])->whereYear('data', date('Y'))->get();

            $i = [
                'nome' => $this->user->find($usuario->aluno_id)->name,
                'presencas' => count($presencas)
            ];
            array_push($alunos, (object)$i);
        }

        return view('user.chamadas-turmas', [
            'title' => 'Chamadas Por Turma',
            'alunos' => $alunos,
            'usuarios' => count($usuarios),
            'presencas' => count($chamadas),
            'atrasos' => count($atrasos),
            'turmas' => $turmas,
            'nomeTurma' => $nomeTurma,
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
