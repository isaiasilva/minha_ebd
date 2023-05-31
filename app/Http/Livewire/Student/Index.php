<?php

namespace App\Http\Livewire\Student;

use App\Models\AlunoPorTurma;
use Illuminate\Database\QueryException;
use Livewire\{Component, WithPagination};

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public int $perpage = 5;

    public string $search = '';

    public function render()
    {
        $alunos = AlunoPorTurma::join('users', 'aluno_por_turmas.user_id', '=', 'users.id')
            ->join('turmas', 'aluno_por_turmas.turma_id', '=', 'turmas.id')
            ->join('igrejas', 'aluno_por_turmas.igreja_id', '=', 'igrejas.id')
            ->orderBy('users.name', 'ASC')
            ->where('users.name', 'LIKE', '%' . $this->search . '%')
            ->orWhere('turmas.nome_turma', 'LIKE', '%' . $this->search . '%')
            ->paginate($this->perpage);

        return view('livewire.student.index', ['alunos' => $alunos]);
    }

    public function delete($user_id, $turma_id)
    {
        $aluno = AlunoPorTurma::where(['user_id' => $user_id, 'turma_id' => $turma_id])->first();

        try {
            $aluno->delete();
            toastr()->addSuccess('Aluno excluído', 'Sucesso');

            return redirect()->back();
        } catch (QueryException $e) {
            env('APP_ENV') == 'local' ? toastr()->addError($e->getMessage()) : toastr()->addError('Não foi possível excluir', 'Erro!');
        }
    }
}
