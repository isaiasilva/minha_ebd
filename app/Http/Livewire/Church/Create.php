<?php

namespace App\Http\Livewire\Church;

use App\Models\Igreja;
use Livewire\Component;

class Create extends Component
{
    public $name;
    protected $rules = [
        'name' => 'required',
    ];

    protected $messages = [
        'name.required' => 'O campo Nome é obrigatório.',
    ];
    public function render()
    {
        return view('livewire.church.create');
    }

    public function store()
    {
        $this->validate();
        Igreja::create(['nome' => $this->name]);
        toastr()->addSuccess('Igreja adicionada', 'Sucesso!');
        return redirect(route('igrejas.index'));
    }
}
