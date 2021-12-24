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
    public function __construct(Turma $turma)
    {
        $this->turma = $turma;
    }

    public function index()
    {
        $turmas = $this->turma::all();

        return view('user.turmas', ['turmas'=>$turmas]);
    }

    public function store()
    {
       return view('user.turma');
    }

    public function create(Request $request)
    {
        $turma = $this->turma;
        $turma->create([
            'nome_turma' => $request->nome_turma
        ]);

        return redirect('user/turma')->with('success', 'Turma registrada com sucesso!');
    }
}
