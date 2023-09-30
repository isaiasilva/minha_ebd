<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public int $perpage = 5;

    public string $search = '';

    public function render()
    {
        return view('livewire.quiz.index', [
            'quizzes' => Quiz::where('igreja_id', getChurch()->id)->where('title', 'LIKE', '%' . $this->search . '%')->paginate($this->perpage),
        ]);
    }
}
