<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'perfil_id',
        'estado_civil',
        'data_nascimento',
        'turma_id',
        'password',
        'telefone'
    ];

    protected $appends = ['presenca', 'igreja'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class, 'id', 'perfil_id');
    }

    public function turmas()
    {
        return $this->hasMany(AlunoPorTurma::class, 'id', 'turma_id');
    }

    public function getPresencaAttribute()
    {
        return Chamada::where(['aluno_id' => $this->id, 'turma_id' => $this->turma_id, 'data' => date('Y-m-d')])->first();
    }

    public function getIgrejaName()
    {
        $igreja = UsuariosPorIgreja::where('user_id', $this->id)->first()->igreja;
        return $igreja->nome;
    }

    public static function getIgreja()
    {
        return UsuariosPorIgreja::where('user_id', Auth::user()->id)->first()->igreja;
    }

    public static function storeUser(
        string $name,
        string $email,
        int $perfil_id,
        string $estado_civil,
        string $data_nascimento,
        int $turma_id,
        ?string $password,
        ?string $telefone,
        ?int $igreja_id
    ) {
        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'perfil_id' => $perfil_id,
                'estado_civil' => $estado_civil,
                'data_nascimento' => $data_nascimento,
                'turma_id' => $turma_id,
                'password' => $password ? Hash::make($password) : Hash::make("ChamadaEBD"),
                'telefone' => $telefone ? $telefone : ""
            ]);

            //Associando primera turma do aluno
            AlunoPorTurma::create([
                'user_id' => $user->id,
                'turma_id' => $turma_id,
                'name' => $name
            ]);

            $igreja = User::getIgreja()->id;

            if ($igreja_id) {
                $igreja = $igreja_id;
            }

            UsuariosPorIgreja::create(['user_id' => $user->id, 'igreja_id' => $igreja]);
        } catch (\Exception $e) {
            return back()->with('error', 'Não foi possível incluir o usuário');
        }
    }
}
