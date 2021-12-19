<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrincipalController extends Controller
{
    public function index()
    {
        $turma = Turma::find(Auth::user()->turma_id);

        $alunos = User::where(['turma_id' => Auth::user()->turma_id, 'PERFIL' => 'ALUNO'])->get();

        return view('user.home', ['turma'=>$turma, 'alunos' => $alunos]);

    }
}
