<?php

namespace App\Http\Controllers;

use App\Models\Chamada;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TurmaController extends Controller
{
    private $turma;
    private $user;
    public function __construct(Turma $turma, User $user)
    {
        $this->turma = $turma;
        $this->user = $user;
    }

    public function index()
    {
        $turmas = $this->turma::all();

        return view('user.turmas', ['turmas'=>$turmas]);
    }

    public function create()
    {
       return view('user.turma');
    }

    public function store(Request $request)
    {
        $turma = $this->turma;
        $turma->create([
            'nome_turma' => $request->nome_turma
        ]);

        return redirect('user/turma')->with('success', 'Turma registrada com sucesso!');
    }

    public function destroy(Request $request)
    {
        $turma = $this->turma->find($request->turma_id);
        $usuarios = $this->user->where(['turma_id'=> $request->turma_id])->get();

        if(count($usuarios) >= 1){
            return redirect('user/turmas')->with('warning', 'Erro ao apagar a turma! Existem alunos');
            // Coleção vazia
        }

        $turma->delete();

        return redirect('user/turmas')->with('success', 'Turma apagada com sucesso!');
    }
}
