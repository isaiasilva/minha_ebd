<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoPorTurma extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'turma_id',
    ];

    public $timestamps = false;

    public function alunos()
    {
        $this->hasMany(User::class);
    }

    public function turmas()
    {
        $this->hasMany(Turma::class);
    }
}
