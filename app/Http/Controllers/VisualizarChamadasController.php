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
}
