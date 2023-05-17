<?php

namespace App\Http\Livewire\Material;

use Livewire\Component;
use App\Models\Material;
use Illuminate\Database\QueryException;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public int $perpage = 5;
    public string $search = '';

    public function render()
    {
        $materials = Material::whereIgrejaId(auth()->user()->getIgreja()->id)
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->where('publicar_em', '<=', date('Y-m-d H:i:s'))
            ->whereYear('created_at', now('Y'))
            ->paginate($this->perpage);

        return view('livewire.material.index', ['materials' => $materials]);
    }

    public function delete(Material $material)
    {
        try {
            $material->delete();
            toastr()->addSuccess('Material excluído', 'Sucesso');
        } catch (QueryException $e) {
            env('APP_ENV') == 'local' ? toastr()->addError($e->getMessage()) : toastr()->addError('Não foi possível excluir', 'Erro!');
        }
    }
}
