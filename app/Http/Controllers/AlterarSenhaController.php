<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AlterarSenhaController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create()
    {
        return view('user.alterar-senha', ['title' => 'Alterar senha']);
    }

    public function store(Request $request)
    {

        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $usuario = $this->user->find(Auth::user()->id);

        $usuario->update([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60)
        ]);

        return redirect()->back()->with('success','Senha alterada com sucesso!');
    }
}
