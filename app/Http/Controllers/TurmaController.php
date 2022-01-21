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

        return view('user.turmas', ['turmas'=>$turmas, 'title' => 'Turmas']);
    }

    public function create()
    {
       return view('user.turma', ['title' => 'Nova Turma']);
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

    public function editar($id)
    {
        $turma = $this->turma->find($id);

        if(is_null($turma)){
            return view('user.turmas')->with('danger', 'Houve algum problema, não encontrei a turma.');
        }
        return view('user.editar-turma', ['title' => 'Editar Turma', 'turma'=> $turma]);
    }

    public function update($id, Request $request)
    {
        $turma = $this->turma->find($id);

        $request->validate(['nome_turma' => 'required|string']);

        $turma->nome_turma = filter_var($request->nome_turma, FILTER_SANITIZE_STRING);
        $turma->save();

        return redirect()->back()->with('success', 'Turma atualizada com sucesso!');

    }
}
