<?php

namespace App\Helper;

use App\Models\Chamada;
use App\Models\ProfessorPorTurma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait Helpers
{
    public function verificaTurmaAtual()
    {
        if (Auth::user()->perfil_id == 1) {
            $turmaAtual = User::find(Auth::user()->id);
        }

        if (Auth::user()->perfil_id == 3) {
            $turmaAtual = ProfessorPorTurma::where(['professor_id' => Auth::user()->id])
                ->get()
                ->first();
        }

        return $turmaAtual;
    }

    public function verificaMaterial($aluno, $turma)
    {
        $data = date('Y-m-d');

        $presenca = Chamada::where(['aluno_id' => $aluno, 'turma_id' => $turma, 'data' => $data])->get();


        $retorno = "no-checked";
        foreach ($presenca as $chamada) {
            if ($chamada->material == true) {
                $retorno = "checked";
            }
        }

        return $retorno;
    }

    private function verificaPresenca($aluno, $turma)
    {
        $data = date('Y-m-d');


        $presenca = Chamada::where(['aluno_id' => $aluno, 'turma_id' => $turma, 'data' => $data])->get();

        //dd($presenca);
        $retorno = "Pendente";
        foreach ($presenca as $chamada) {
            if ($chamada->id && $chamada->atraso == true) {
                $retorno = "Atraso";
            } else if ($chamada->id && $chamada->atraso == false) {
                $retorno = "Presença";
            }
        }

        return $retorno;
    }
}
