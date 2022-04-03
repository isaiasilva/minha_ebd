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
        return $this->hasMany(User::class, 'id', 'aluno_id');
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class, 'id', 'turma_id');
    }
}
