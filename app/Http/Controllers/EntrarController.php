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
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))){
            return redirect()
                ->back()
                ->withErrors('Erro ao tentar se logar');
        }


        $turma = Turma::find(Auth::user()->turma_id);



        return view('user.home', ['turma'=> $turma]);
    }
}
