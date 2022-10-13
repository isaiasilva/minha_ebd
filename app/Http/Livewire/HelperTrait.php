<?php

namespace  App\Http\Livewire;

use App\Models\Chamada;

trait HelperTrait
{

    public static function verificaPresenca($aluno, $turma, $data)
    {
        return Chamada::where(['aluno_id' => $aluno, 'turma_id' => $turma, 'data' => $data])->first();
    }
}
