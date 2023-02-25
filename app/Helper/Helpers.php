<?php

namespace App\Helper;

use App\Models\Chamada;
use App\Models\Perfil;
use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

trait Helpers
{
    public function verificaTurmas()
    {

        if (Auth::user()->perfil_id == Perfil::SUPERINTENDENTE || Auth::user()->perfil_id == Perfil::ADMINISTRADOR) {
            $turmas = Turma::where(['igreja_id' => User::getIgreja()->id])->get();
        }
        if (Auth::user()->perfil_id == Perfil::PROFESSOR) {
            $turmasPorProfessor =  ProfessorPorTurma::where(['professor_id' => Auth::user()->id, 'igreja_id' => User::getIgreja()->id])->get();
            $collect = new Collection();
            $turmasPorProfessor->map(function ($turmaPorProfessor) use (&$collect) {
                $turma = Turma::find($turmaPorProfessor->turma_id);

                $collect->push($turma);
            });
            $turmas = $collect;
        }

        return $turmas;
    }

    public function verificaMaterial($aluno, $turma)
    {
        $data = date('Y-m-d');

        $presenca = Chamada::where(['' => $aluno, 'turma_id' => $turma, 'data' => $data])->get();


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
