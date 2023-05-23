<?php

namespace App\Http\Controllers;

use App\Models\{Turma, User};
use Illuminate\Support\Facades\Auth;

class AlunosController extends Controller
{
    public function index()
    {
        $turma = Turma::find(Auth::user()->turma_id);

        $alunos = User::where(['turma_id' => Auth::user()->turma_id, 'perfil_id' => 2])->get();

        return view('user.alunos', ['turma' => $turma, 'alunos' => $alunos, 'title' => 'Alunos']);

    }

}
