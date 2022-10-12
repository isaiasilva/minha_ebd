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
use Livewire\WithPagination;

class Chamada extends Component
{
    use Helpers;
    use WithPagination;

    public $perpage = 5;
    protected $paginationTheme = 'bootstrap';
    public $search = '';

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
        if ($request->id) {
            $this->turmaAtual = $request->id;
        } else {
            $this->turmaAtual = User::find(Auth::user()->id)->turma_id;
        }



        $this->atraso = false;
        $this->material = true;
    }


    public function render(Request $request)
    {

        $minhasTurmas = ProfessorPorTurma::where(['professor_id' => Auth::user()->id])->get();
        $turmas = Turma::all();

        $verificaTurma = $this->verificaTurmaAtual();

        if (is_null($verificaTurma)) {
            return redirect('/user/home')->with('warning', 'Professor não foi associado em nenhuma turma');
        }

        $turmaAtual = $verificaTurma->turma_id;
        $nomeTurma = Turma::find($turmaAtual)->nome_turma;


        if (isset($request->id)) {
            $turmaAtual = $request->id;
            $nomeTurma = Turma::find($turmaAtual)->nome_turma;
        }

        $this->minhasTurmas = $minhasTurmas;
        $this->turmas = $turmas;
        $this->nomeTurma = $nomeTurma;


        return view(
            'livewire.chamada',
            [
                'alunos' => AlunoPorTurma::where(['turma_id' => $this->turmaAtual])->paginate($this->perpage)
            ]
        );
    }

    public function store($aluno_id)
    {
        $data = date('Y-m-d');

        $chamada =  ChamadaModel::create([
            'data' => $data,
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
        $chamada = ChamadaModel::where(['aluno_id' => $aluno_id, 'turma_id' => $this->turmaAtual, 'data' => date('Y-m-d')])->first();

        $chamada->delete();
        toastr()->addSuccess('Presença apagada com sucesso!', 'Feito!');
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
}
