<?php

namespace App\Livewire\Comment;

use App\Models\Material;
use Livewire\Component;

class Create extends Component
{
    public Material $material;

    public $text;

    public $rules = ['text' => 'required|min:10'];

    public $messages = ['required' => 'Campo obrigatório!', 'min' => 'O comentário precisa ter pelo menos 10 caracteres'];

    public function render()
    {
        return view('livewire.comment.create');
    }

    public function store()
    {
        $this->validate();
        auth()->user()->comentarios()->create(['text' => $this->text, 'material_id' => $this->material->id]);
        $this->reset(['text']);
        $this->dispatch('reload');
        toastr()->addSuccess('Comentário publicado', 'Sucesso!');
    }
}
