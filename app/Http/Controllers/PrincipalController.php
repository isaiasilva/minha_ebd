<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    private $turma;
    private $user;
    private $perfil;
    public function __construct(Turma $turma, User $user, Perfil $perfil)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
    }

    public function index()
    {
        $turma = Turma::find(Auth::user()->turma_id);

        $perfil = $this->perfil->find(Auth::user()->perfil_id);;

        $alunos = User::where(['turma_id' => Auth::user()->turma_id, 'perfil_id' => 2])->get();

        return view('user.home', ['turma'=>$turma, 'alunos' => $alunos, 'perfil' => $perfil]);

    }
}
