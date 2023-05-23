<?php

namespace App\Http\Livewire\Material;

use App\Models\Material;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Show extends Component
{
    public Material $material;
    public function render()
    {
        return view('livewire.material.show');
    }

    public function deleteFile(Material\Arquivo $arquivo)
    {
        try {
            $arquivo->delete();
            Storage::delete($arquivo->caminho_arquivo);
            toastr()->addSuccess('Arquivo apagado', 'Sucesso');

            return redirect(route('material.show', $this->material->id));
        } catch (QueryException $e) {
            env('APP_ENV') == 'local' ? toastr()->addError($e->getMessage()) : toastr()->addError('Não foi possível excluir', 'Erro!');

        }
    }

    public function deleteLink(Material\LinkExterno $linkExterno)
    {
        try {
            $linkExterno->delete();
            toastr()->addSuccess('Link apagado', 'Sucesso');

            return redirect(route('material.show', $this->material->id));
        } catch (QueryException $e) {
            env('APP_ENV') == 'local' ? toastr()->addError($e->getMessage()) : toastr()->addError('Não foi possível excluir', 'Erro!');

        }
    }

    public function deleteYouTube(Material\YouTube $youTube)
    {
        try {
            $youTube->delete();

            toastr()->addSuccess('Vídeo apagado', 'Sucesso');

            return redirect(route('material.show', $this->material->id));
        } catch (QueryException $e) {
            env('APP_ENV') == 'local' ? toastr()->addError($e->getMessage()) : toastr()->addError('Não foi possível excluir', 'Erro!');

        }
    }
}
