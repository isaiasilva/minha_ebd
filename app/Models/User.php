<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
    ];

    protected $appends = ['presenca'];

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
}
