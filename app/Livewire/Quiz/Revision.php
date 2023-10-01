<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\{Component, WithPagination};

class Revision extends Component
{
    use WithPagination;

    public Quiz $quiz;

    public function render()
    {
        $questions = $this->quiz->questions()->with('items')->paginate(1);

        return view('livewire.quiz.revision', compact('questions'));
    }
}
