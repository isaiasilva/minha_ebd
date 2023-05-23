<?php

namespace App\Http\Livewire;

use App\Helper\Helpers;
use App\Models\{AlunoPorTurma, Chamada as ChamadaModel, ProfessorPorTurma, Turma, User};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\{Component, WithPagination};

class Chamada extends Component
{
    use Helpers;
    use WithPagination;

    public $perpage = 15;

    protected $paginationTheme = 'bootstrap';

    public $data;

    public $search;

    public $turmaAtual;

    public $minhasTurmas;

    public $turmas;

    public $nomeTurma;

    public $professor;

    public $turma;

    public $atraso;

    public $material;

    protected $rules = [
        'data' => 'required',
    ];

    protected $messages = ['data.required' => 'A data é obrigatória!'];

    public function mount(Request $request)
    {
        $turmas = $this->getTurmas();

        if (is_null($turmas->first())) {
            toastr()->addError('Não foi encontrado nenhuma turma', 'Erro');

            return redirect('/user/home');
        }

        $turma = $turmas->first();

        $this->minhasTurmas = $turmas;
        $this->nomeTurma    = $turma->nome_turma;
        $this->data         = date('Y-m-d');
        $this->turmaAtual   = $turma->id;
        $this->turma        = $turmas->first();

        if ($request->id) {
            $this->turmaAtual = $request->id;
            $this->turma      = Turma::find($request->id);
        }

        $this->turmas   = Turma::where('igreja_id', User::getIgreja()->id)->get();
        $this->atraso   = false;
        $this->material = true;
    }

    public function render()
    {
        return view(
            'livewire.chamada',
            [
                'alunos' => AlunoPorTurma::where(['turma_id' => $this->turmaAtual])->where('name', 'like', '%' . $this->search . '%')
                    ->orderBy('name', 'ASC')
                    ->paginate($this->perpage),
            ]
        );
    }

    public function store($aluno_id)
    {
        $this->validate();
        $chamada = ChamadaModel::where(['aluno_id' => $aluno_id, 'data' => $this->data])->first();

        if ($chamada) {
            return toastr()->addWarning('Não foi possível registrar a presença. Aluno já tem a presença em outra turma hoje.', 'Atenção!');
        }
        $chamada = ChamadaModel::create([
            'data'         => $this->data,
            'professor_id' => Auth::user()->id,
            'turma_id'     => $this->turmaAtual,
            'aluno_id'     => $aluno_id,
            'atraso'       => $this->atraso,
            'material'     => $this->material,
            'igreja_id'    => User::getIgreja()->id,
        ]);

        if ($this->atraso === true) {
            $this->restauraValoresAtrasoMaterial();

            return toastr()->addWarning('Atraso registrado com sucesso', 'Feito');
        }

        $this->restauraValoresAtrasoMaterial();

        return toastr()->addSuccess('Presença registrada com sucesso', 'Feito!');
    }

    public function destroy($aluno_id)
    {
        try {
            $chamada = ChamadaModel::where(['aluno_id' => $aluno_id, 'turma_id' => $this->turmaAtual, 'data' => $this->data])->first();
            $chamada->delete();
            toastr()->addSuccess('Presença apagada com sucesso!', 'Feito!');
        } catch (Exception $e) {
            toastr()->addError('Não foi possível excluir. Por favor, procure a superintendência.', 'Feito!');
        }
    }

    public function registraAtraso(): void
    {

        if ($this->atraso == false) {

            $this->atraso = true;

            return;
        }

        if ($this->atraso == true) {
            $this->atraso = false;

            return;
        }
    }

    public function registraMaterial()
    {

        if ($this->material == true) {
            $this->material = false;

            return;
        }

        if ($this->material == false) {
            $this->material = true;

            return;
        }
    }

    public function restauraValoresAtrasoMaterial()
    {
        $this->atraso   = false;
        $this->material = true;
    }

    public function verificaPresenca($user_id)
    {
        try {
            return ChamadaModel::where(['aluno_id' => $user_id, 'turma_id' => $this->turmaAtual, 'data' => $this->data])->first();
        } catch (Exception $e) {
            return toastr()->addError('O correu um erro! Verifique se a data está preenchida normalmente', 'Erro!');
        }
    }
}
