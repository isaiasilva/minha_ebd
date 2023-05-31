<?php

namespace App\Http\Livewire\Material;

use App\Models\{Material, Perfil};
use Illuminate\Database\QueryException;
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perpage = 5;

    public string $search = '';

    public function render()
    {
        if (auth()->user()->perfil_id == Perfil::ADMINISTRADOR) {
            $materials = Material::where('titulo', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'desc')
                ->whereYear('created_at', now('Y'))
                ->paginate($this->perpage);

            return view('livewire.material.index', ['materials' => $materials]);
        }

        $materials = Material::whereIgrejaId(auth()->user()->getIgreja()->id)
            ->orWhere('material_global', true)
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

            return redirect()->back();
        } catch (QueryException $e) {
            env('APP_ENV') == 'local' ? toastr()->addError($e->getMessage()) : toastr()->addError('Não foi possível excluir', 'Erro!');
        }
    }
}
