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

    public function answer($question, $item)
    {
        session()->put("quiz.{$this->quiz->id}.{$question}", $item);
    }

    public function answered($question, $item): bool
    {
        return session()->has("quiz.{$this->quiz->id}.{$question}") && session()->get("quiz.{$this->quiz->id}.{$question}") == $item;
    }

    public function result()
    {
        $score    = 0;
        $template = session()->get("quiz.{$this->quiz->id}");

        if (isset($template) && count($template) < $this->quiz->questions->count()) {
            $this->addError('countQustions', 'Você precisa responder todas as questões para ver o resultado.');

            return;
        }

        foreach ($template as $question => $item) {
            if ($this->quiz->questions()->find($question)->items()->where('id', $item)->first()->is_correct) {
                $score++;
            }
        }

        $this->js("alert('Você acertou {$score} questões!')");

        session()->forget("quiz.{$this->quiz->id}");
    }
}
