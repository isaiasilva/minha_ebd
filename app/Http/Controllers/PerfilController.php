<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
use App\Models\Perfil;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    private $turma;
    private $perfil;
    private $user;


    public function __construct(Turma $turma, Perfil $perfil, User $user)
    {
        $this->turma = $turma;
        $this->perfil = $perfil;
        $this->user = $user;
    }

    public function index()
    {
        $turma = $this->turma->find(Auth::user()->turma_id)->nome_turma;
        $perfil = $this->perfil->find(Auth::user()->perfil_id)->perfil;

        return view('user.perfil', ['turma' => $turma, 'perfil' => $perfil, 'title' => 'Perfil']);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'estado_civil' => 'required',
            'data_nascimento' => 'required',
        ]);

        $usuario = $this->user->find($request->id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->estado_civil = $request->estado_civil;
        $usuario->data_nascimento = $request->data_nascimento;
        $usuario->telefone = $request->telefone;


        $usuario->save();

        return redirect()->back()->with('success', 'Perfil atualizado com sucesso!');
    }
}
