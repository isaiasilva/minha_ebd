<?php

namespace App\Helper;

use App\Models\{Chamada, Perfil, ProfessorPorTurma, Turma, User};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

trait Helpers
{
    public function getTurmas()
    {

        if (Auth::user()->perfil_id == Perfil::SUPERINTENDENTE || Auth::user()->perfil_id == Perfil::ADMINISTRADOR) {
            $turmas = Turma::where(['igreja_id' => User::getIgreja()->id, 'is_active' => true])->get();

            return $turmas;
        }

        $turmasPorProfessor = ProfessorPorTurma::where(['professor_id' => Auth::user()->id, 'igreja_id' => User::getIgreja()->id])->get();
        $collect            = new Collection();
        $turmasPorProfessor->map(function (ProfessorPorTurma $turmaPorProfessor) use (&$collect) {
            $turma = Turma::find($turmaPorProfessor->turma_id);

            $turma->is_active ? $collect->push($turma) : null;
        });
        $turmas = $collect;

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
