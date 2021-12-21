<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    use HasFactory;
    protected $fillable = [
        'data',
        'turma',
        'professor',
        'aluno',
    ];

    public $timestamps = false;

    public function aluno()
    {
        return $this->hasOne(User::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }


}
