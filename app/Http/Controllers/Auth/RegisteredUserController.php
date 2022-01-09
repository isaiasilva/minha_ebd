<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AlunoPorTurma;
use App\Models\Perfil;
use App\Models\ProfessorPorTurma;
use App\Models\Turma;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    private $turma;
    private $perfil;
    /**
     * @var AlunoPorTurma
     */
    private $alunoPorTurma;
    /**
     * @var ProfessorPorTurma
     */
    private $professorPorTurma;

    public function __construct(Turma $turma, Perfil $perfil, AlunoPorTurma $alunoPorTurma, ProfessorPorTurma $professorPorTurma)
    {
        $this->turma = $turma;
        $this->perfil = $perfil;
        $this->alunoPorTurma = $alunoPorTurma;
        $this->professorPorTurma = $professorPorTurma;
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $turmas = $this->turma::all();
        $perfis = $this->perfil::all();

        return view('auth.registrar', ['turmas' => $turmas, 'perfis' => $perfis, 'title' => 'Novo usuário']);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function registrarAluno()
    {
        $repositorioTurmas = $this->turma;
         $turmas = $this->professorPorTurma->where('professor_id',Auth::user()->id )->get();

        return view('auth.registrar-aluno', ['turmas' => $turmas, 'repositorioTurmas' => $repositorioTurmas]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'perfil_id' => ['required'],
            'estado_civil' => ['required', 'string'],
            'data_nascimento' => ['required', 'date'],
            'turma_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'perfil_id' => $request->perfil_id,
            'estado_civil' => $request->estado_civil,
            'data_nascimento' => $request->data_nascimento,
            'turma_id' => $request->turma_id,
            'password' => Hash::make($request->password),
        ]);

         //Associando primera turma do aluno
         $this->alunoPorTurma->create([
             'aluno_id' => $user->id,
             'turma_id' => $user->turma_id
         ]);



            return redirect()
                ->back()
                ->with('success', 'Usuário inserido com sucesso');
    }
}
