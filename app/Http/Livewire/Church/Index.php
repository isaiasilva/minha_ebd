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
}
