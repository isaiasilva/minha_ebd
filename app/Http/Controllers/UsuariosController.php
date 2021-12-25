<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
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

    public function __construct(Turma $turma, User $user, Perfil $perfil)
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
    }

    public function index()
    {
        $turma = $this->turma->find(Auth::user()->turma_id);
        $perfil = $this->perfil;
        $usuarios = $this->user->all();
        return view('user.usuarios', ['turma'=>$turma, 'usuarios' => $usuarios, 'perfil' => $perfil]);
    }
}
