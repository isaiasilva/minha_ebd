<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    /**
     * @var Turma
     */
    private $turma;
    /**
     * @var Perfil
     */
    private $perfil;

    public function __construct(Turma $turma, Perfil $perfil)
    {
        $this->turma = $turma;
        $this->perfil = $perfil;
    }

    public function index()
    {
        $turma = $this->turma->find(Auth::user()->turma_id)->nome_turma;
        $perfil = $this->perfil->find(Auth::user()->perfil_id)->perfil;

        return view('user.perfil', ['turma'=> $turma, 'perfil' => $perfil]);
    }
}
