<?php

namespace App\Http\Controllers;

use App\Models\AlunoPorTurma;
use App\Models\Chamada;
use App\Models\Perfil;
use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    /**
     * @var Turma
     */
    private $turma;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Perfil
     */
    private $perfil;
    /**
     * @var Chamada
     */
    private $chamada;
    /**
     * @var ProfessorPorTurma
     */
    private $professorPorTurma;
    /**
     * @var AlunoPorTurma
     */
    private $alunoPorTurma;

    public function __construct(
        Turma $turma,
        User $user,
        Perfil $perfil,
        Chamada $chamada,
        ProfessorPorTurma $professorPorTurma,
        AlunoPorTurma $alunoPorTurma
    )
    {
        $this->turma = $turma;
        $this->user = $user;
        $this->perfil = $perfil;
        $this->chamada = $chamada;
        $this->professorPorTurma = $professorPorTurma;
        $this->alunoPorTurma = $alunoPorTurma;
    }

    public function index()
    {
        $turma = $this->turma->find(Auth::user()->turma_id);
        $perfil = $this->perfil;
        $usuarios = $this->user->all();
        return view('user.usuarios', ['turma'=>$turma, 'usuarios' => $usuarios, 'title' => 'Usuários', 'perfil' => $perfil]);
    }

    public function destroy($id)
    {
        $usuario = $this->user->find($id);

        // se for professor
        if($usuario->perfil_id === "3"){
            $colecaoProfessor = $this->professorPorTurma->where('professor_id',$usuario->id )->get();
            $this->excluirProfessorPorTurma($colecaoProfessor);
        }

        $alunosPorTurma = $this->alunoPorTurma->where('aluno_id',$usuario->id)->get();

        $this->delataAlunoPorTurma($alunosPorTurma);

        $chamadas = $this->chamada->where('aluno_id',$usuario->id)->get();

        $this->excluirChamada($chamadas);

        $usuario->delete();
        return redirect()->back()->with('success', 'Usuário excluido com sucesso.');
    }

    public function editarUsuario($id)
    {
        $usuario = $this->user->find($id);
        $perfil = $this->perfil->find($usuario->perfil_id);
        $perfis = $this->perfil->all();

        $turma = $this->turma->find($usuario->turma_id);
        $turmas = $this->turma->all();

        //dd($perfil);

        return view('user.editar-usuario',[
            'title' => 'Editar Usuários',
            'usuario' => $usuario,
            'perfis' => $perfis,
            'perfilAtual' => $perfil,
            'turmas' => $turmas,
            'turmaAtual' => $turma
        ]);
    }

    public function update($id, Request $request)
    {
        $usuario = $this->user->find($id);

        $usuario->name = filter_var($request->name, FILTER_SANITIZE_STRING);
        $usuario->email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $usuario->perfil_id = filter_var($request->perfil_id, FILTER_SANITIZE_STRING);
        $usuario->data_nascimento = filter_var($request->data_nascimento, FILTER_SANITIZE_STRING);
        $usuario->estado_civil = filter_var($request->estado_civil, FILTER_SANITIZE_STRING);
        $usuario->turma_id = filter_var($request->turma_id, FILTER_SANITIZE_STRING);

        $this->atualizaAlunoPorTurma($usuario->id, $usuario->turma_id);

        /*
         * Verificar se o perfil é de professor e se existe uma turma associada para excluir
        if($usuario->perfil_id === 3 && ){

        }
        */

        $usuario->save();

        return redirect()->back()->with('success','Usuário atualizado com sucesso!');

    }



    /**
     * @param $ColecaoProfessor
     */
    protected function excluirProfessorPorTurma($ColecaoProfessor): void
    {
        foreach ($ColecaoProfessor as $professor) {
            $professor->delete();
        }
    }

    /**
     * @param $chamadas
     */
    protected function excluirChamada($chamadas): void
    {
        foreach ($chamadas as $chamada) {
            $chamada->delete();
        }
    }

    /**
     * @param $alunosPorTurma
     */
    protected function delataAlunoPorTurma($alunosPorTurma): void
    {
        foreach ($alunosPorTurma as $alunoPorTurma) {
            $alunoPorTurma->delete();
        }
    }

    protected function atualizaAlunoPorTurma($usuario_id, $turma_id)
    {
        $alunoPorTurma = $this->alunoPorTurma;
        if(count($alunoPorTurma->where([
                'aluno_id' => $usuario_id,
                'turma_id' => $turma_id
            ])->get()) === 1)
        {
            // retorna nada caso o usuario já esteja associado a turma
            return false;
        }

        $alunoPorTurma->create([
            'aluno_id' => $usuario_id,
            'turma_id' => $turma_id
        ]);

        return true;

    }




}
