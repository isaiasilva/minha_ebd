<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
use App\Models\Turma;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
                'turma' => $this->turma->find($request->turma),
                'alunos' => $this->alunos->where('turma_id', $request->turma)->orderBy('name')->get()
            ]
        );
        return $pdf->stream();
    }
}
