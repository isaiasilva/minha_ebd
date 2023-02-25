<?php

namespace App\Http\Livewire;

use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use App\Models\Chamada as ChamadaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Helper\Helpers;
use App\Models\AlunoPorTurma;
use Exception;
use Livewire\WithPagination;

class Chamada extends Component
{
    use Helpers;
    use WithPagination;

    public $perpage = 5;
    protected $paginationTheme = 'bootstrap';
    public $data;

    public $turmaAtual;
    public $minhasTurmas;
    public $turmas;
    public $nomeTurma;
    public $professor;
    public $turma;

    public $atraso;
    public $material;


    public function mount(Request $request)
    {
        $turmas = $this->verificaTurmas();

        if (is_null($turmas)) {
            return redirect('/user/home')->with('warning', 'Professor não foi associado em nenhuma turma');
        }

        $turma = $turmas->first();

        $this->minhasTurmas = $turmas;
        $this->nomeTurma = $turma->nome_turma;
        $this->data = date('Y-m-d');
        $this->turmaAtual = $turma->id;
        $this->turma = $turmas->first();
        if ($request->id) {
            $this->turmaAtual = $request->id;
            $this->turma = Turma::find($request->id);
        }

        $this->turmas = Turma::where('igreja_id', User::getIgreja()->id)->get();
        $this->atraso = false;
        $this->material = true;
    }


    public function render()
    {
        return view(
            'livewire.chamada',
            [
                'alunos' => AlunoPorTurma::where(['turma_id' => $this->turmaAtual])
                    ->orderBy('name', 'ASC')
                    ->paginate($this->perpage)
            ]
        );
    }

    public function store($aluno_id)
    {
        $chamada =  ChamadaModel::create([
            'data' => $this->data,
            'professor_id' => Auth::user()->id,
            'turma_id' => $this->turmaAtual,
            'aluno_id' => $aluno_id,
            'atraso' => $this->atraso,
            'material' => $this->material,
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
        $this->atraso = false;
        $this->material = true;
    }

    public function verificaPresenca($user_id)
    {
        return ChamadaModel::where(['aluno_id' => $user_id, 'turma_id' => $this->turma_id, 'data' => $this->data])->first();
    }
}
