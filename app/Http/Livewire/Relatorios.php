<?php

namespace App\Http\Livewire;

use App\Models\{AlunoPorTurma, Igreja, Turma};
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Livewire\Component;

class Relatorios extends Component
{
    public $turmas = [];

    public $igrejas;

    public $igreja_id;

    public $turma_id;

    public array $rules = [
        'igreja_id' => 'required',
        'turma_id'  => 'required',
    ];

    public function mount()
    {
        $this->igrejas = Igreja::all();
    }
    public function render()
    {
        return view('livewire.relatorios');
    }

    public function renderPdf(Request $request)
    {
        $this->validate();
        $pdf = Pdf::loadView(
            'relatorios.aluno-por-turma',
            [
                'turma'  => Turma::find($this->turma_id),
                'alunos' => AlunoPorTurma::where('turma_id', $this->turma_id)->orderBy('name')->get(),
            ]
        );

        return $pdf->stream();
    }

    public function recuperaTurmas()
    {
        //$this->turmas = Turma::where('igreja_id', auth()->user()->getIgreja()->id)->get();
        $this->turmas = Turma::where('igreja_id', $this->igreja_id)->get();
    }
}
