<?php

namespace App\Http\Livewire\Material;

use App\Models\Material;
use Livewire\Component;

class Show extends Component
{
    public Material $material;
    public function render()
    {
        return view('livewire.material.show');
    }
}
