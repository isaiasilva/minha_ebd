<?php

namespace App\Http\Controllers;

use App\Models\{AlunoPorTurma, Turma};
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function __construct(protected Turma $turma, protected AlunoPorTurma $alunos)
    {
    }

    public function alunosPorTurma(Request $request)
    {

        $pdf = Pdf::loadView(
            'relatorios.aluno-por-turma',
            [
                'turma'  => $this->turma->find($request->turma),
                'alunos' => $this->alunos->where('turma_id', $request->turma)->orderBy('name')->get(),
            ]
        );

        return $pdf->stream();
    }
}
