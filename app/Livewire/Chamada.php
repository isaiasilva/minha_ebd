<?php

namespace App\Livewire;

use App\Helper\Helpers;
use App\Jobs\XPJob;
use App\Models\{AlunoPorTurma, Chamada as ChamadaModel, Turma, User};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Session};
use Livewire\{Component, WithPagination};

class Chamada extends Component
{
    use Helpers;
    use WithPagination;

    public $perpage = 15;

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

    protected function rules()
    {
        return [
            'data' => 'required',

        ];
    }

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

        $this->turmas   = Turma::where(['igreja_id' => User::getIgreja()->id, 'is_active' => true])->orderBy('nome_turma', 'ASC')->get();
        $this->atraso   = false;
        $this->material = true;
    }

    public function render()
    {
        return view(
            'livewire.chamada',
            [
                'alunos' => AlunoPorTurma::whereHas('user', function ($query) {
                    $query->where('is_active', true);
                })
                    ->where(['turma_id' => $this->turmaAtual])->where('name', 'like', '%' . $this->search . '%')
                    ->orderBy('name', 'ASC')
                    ->paginate($this->perpage),
            ]
        );
    }

    public function store(int $aluno_id, bool $absence = false)
    {
        $this->validate();
        $chamada = ChamadaModel::where(['aluno_id' => $aluno_id, 'data' => $this->data])->first();

        if ($chamada) {
            Session::flash('error', 'Não foi possível registrar a presença. Aluno já tem a presença em outra turma hoje.');

            return;
        }
        $chamada = ChamadaModel::create([
            'data'              => $this->data,
            'professor_id'      => Auth::user()->id,
            'turma_id'          => $this->turmaAtual,
            'aluno_id'          => $aluno_id,
            'atraso'            => $this->atraso,
            'falta_justificada' => $absence,
            'material'          => $this->material,
            'igreja_id'         => User::getIgreja()->id,
        ]);

        $user = User::find($aluno_id);

        if ($absence === true) {
            $this->restauraValoresAtrasoMaterial();
            XPJob::dispatch($user, 2);
            Session::flash('warning', 'Falta justificada registrada com sucesso.');

            return;
        }

        if ($this->atraso === true) {
            $this->restauraValoresAtrasoMaterial();
            XPJob::dispatch($user, 7);

            Session::flash('warning', 'Atraso registrado com sucesso');

            return;
        }

        $this->restauraValoresAtrasoMaterial();

        XPJob::dispatch($user, 10);

        Session::flash('success', 'Presença registrada com sucesso!');

    }

    public function destroy($aluno_id)
    {
        try {
            $chamada = ChamadaModel::where(['aluno_id' => $aluno_id, 'turma_id' => $this->turmaAtual, 'data' => $this->data])->first();
            $chamada->delete();
            $user = User::find($aluno_id);

            if ($chamada->atraso) {
                XPJob::dispatch($user, -7);
                Session::flash('success', 'Presença apagada com sucesso!');

                return;
            }

            if ($chamada->falta_justificada) {
                XPJob::dispatch($user, -2);
                Session::flash('success', 'Presença apagada com sucesso!');

                return;
            }

            XPJob::dispatch($user, -10);

            Session::flash('success', 'Presença registrada com sucesso!');
        } catch (Exception $e) {

            Session::flash('error', 'Não foi possível excluir. Por favor, procure a superintendência.');

            return;
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

            Session::flash('error', 'Ocorreu um erro! Verifique se a data está preenchida normalmente');

            return;
        }
    }
}
