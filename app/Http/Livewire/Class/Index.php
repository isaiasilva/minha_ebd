<?php

namespace App\Http\Livewire\Class;

use App\Models\{Turma, User};
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    public $perpage = 5;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    public function render()
    {
        $turmas = Turma::where('igreja_id', User::getIgreja()->id)
            ->where('nome_turma', 'like', '%' . $this->search . '%')
            ->paginate($this->perpage);

        return view('livewire.class.index', ['turmas' => $turmas]);
    }

    public function changeStatus(Turma $turma)
    {
        $turma->is_active = !$turma->is_active;
        $turma->save();
    }
}
