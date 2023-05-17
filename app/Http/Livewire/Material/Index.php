<?php

namespace App\Http\Livewire\Material;

use Livewire\Component;
use App\Models\Material;

class Index extends Component
{
    public function render()
    {
        $materials = Material::all();
        return view('livewire.material.index', ['materials' => $materials]);
    }
}
