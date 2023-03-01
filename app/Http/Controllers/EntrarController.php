<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntrarController extends Controller
{
    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    protected array $messages = [
        'email.required' => "Campo email é obrigatório.",
        'email.email' => "Campo email precisa ser de um formato válido.",
        'password.required' => "Campo eenha é obrigatório."
    ];

    public function index()
    {
        if (Auth::user()) {
            redirect(route('principal'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);

        if (!Auth::attempt($request->only(['email', 'password']))) {
            toastr()->addError('Usuário ou senha inválidos', 'Erro');
            return redirect()
                ->back()
                ->withInput($request->except('password'));
        }
        return redirect('/user/home');
    }
}
