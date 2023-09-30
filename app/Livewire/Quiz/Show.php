<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\Component;

class Show extends Component
{
    public Quiz $quiz;

    public function render()
    {
        return view('livewire.quiz.show');
    }
}
