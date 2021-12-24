<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
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

    public function __construct(Turma $turma, Perfil $perfil)
    {
        $this->turma = $turma;
        $this->perfil = $perfil;
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

        return view('auth.registrar', ['turmas' => $turmas, 'perfis' => $perfis]);
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function registrarAluno()
    {
        $turma = Turma::find(Auth::user()->turma_id);
        return view('auth.registrar-aluno', ['turma' => $turma]);
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
            'perfil' => ['required'],
            'estado_civil' => ['required', 'string'],
            'data_nascimento' => ['required', 'date'],
            'turma_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'perfil' => $request->perfil,
            'estado_civil' => $request->estado_civil,
            'data_nascimento' => $request->data_nascimento,
            'turma_id' => $request->turma_id,
            'password' => Hash::make($request->password),
        ]);
        /*
        event(new Registered($user));
        Auth::login($user); */


            return redirect()
                ->back()
                ->with('success', 'Usuário inserido com sucesso');
    }
}
