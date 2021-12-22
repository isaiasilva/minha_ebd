<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function index()
    {
        $turma = Turma::find(Auth::user()->turma_id);

        $usuarios = User::all();
        return view('user.usuarios', ['turma'=>$turma, 'usuarios' => $usuarios]);
    }
}
