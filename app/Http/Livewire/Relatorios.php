<?php

namespace App\Http\Livewire;

use App\Models\{AlunoPorTurma, Turma};
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;

class Relatorios extends Component
{
    public $turmas;

    public $turma_id;
    public function mount()
    {
        $this->turmas = Turma::all();
    }
    public function render()
    {
        return view('livewire.relatorios');
    }

    public function renderPdf(Request $request)
    {
        $pdf = Pdf::loadView(
            'relatorios.aluno-por-turma',
            [
                'turma'  => Turma::find($this->turma_id),
                'alunos' => AlunoPorTurma::where('turma_id', $this->turma_id)->orderBy('name')->get(),
            ]
        );

        return $pdf->stream();
    }
}
