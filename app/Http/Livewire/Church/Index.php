<?php

namespace App\Http\Livewire\Church;

use App\Models\Igreja;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.church.index', ['igrejas' => Igreja::orderBy('nome')->paginate(10)]);
    }

    public function destroy(Igreja $igreja)
    {
        try {
            $igreja->delete();

            toastr()->addSuccess('Igreja apagada com sucesso!', 'Feito');
        } catch (\Exception $e) {
            toastr()->addError('Não foi possível excluir Igreja pois existem registro associados a ela!', 'Erro');
        }
    }
}
