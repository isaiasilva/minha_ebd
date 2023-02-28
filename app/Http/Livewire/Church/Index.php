<?php

namespace App\Http\Livewire\Church;

use App\Models\Igreja;
use Livewire\Component;

class Index extends Component
{
    public $igrejas;

    public function mount()
    {
        $this->igrejas = Igreja::all();
    }
    public function render()
    {
        return view('livewire.church.index');
    }

    public function destroy(Igreja $igreja)
    {
        try {
            $igreja->delete();
            $this->igrejas = Igreja::all();
            toastr()->addSuccess('Igreja apagada com sucesso!', 'Feito');
        } catch (\Exception $e) {
            toastr()->addError('Não foi possível excluir Igreja pois existem registro associados a ela!', 'Erro');
        }
    }
}
