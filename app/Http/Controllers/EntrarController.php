<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntrarController extends Controller
{
    public function index()
    {

        if (Auth::user()) {
            redirect(route('principal'));
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return redirect()
                ->back()
                ->withErrors('Usuário ou senha inválido')->withInput($request->except('password'));
        }
        return redirect('/user/home');
    }
}
