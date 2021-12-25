<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\Perfil;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    /**
     * @var Turma
     */
    private $turma;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Perfil
     */
    private $perfil;
    /**
     * @var Chamada
     */
    private $chamada;

    public function __construct(Turma $turma, User $user, Perfil $perfil, Chamada $chamada)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
        $this->chamada = $chamada;
    }

    public function index()
    {
        $turma = $this->turma->find(Auth::user()->turma_id);

        $chamada= $this->chamada->where('data', date('Y-m-d'))->get();
        $presencas = count($chamada);
        $perfil = $this->perfil->find(Auth::user()->perfil_id);;
        $alunos = $this->user->where(['turma_id' => Auth::user()->turma_id, 'perfil_id' => 2])->get();

        return view('user.home', ['turma'=>$turma, 'alunos' => $alunos, 'perfil' => $perfil, 'presencas' => $presencas]);

    }
}
