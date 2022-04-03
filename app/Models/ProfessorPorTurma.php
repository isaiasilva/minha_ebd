<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorPorTurma extends Model
{
    use HasFactory;

    protected $fillable = [
        'professor_id',
        'turma_id',
    ];

    public $timestamps = false;

    public function professores()
    {
        return $this->hasMany(User::class, 'id', 'professor_id');
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class, 'id', 'turma_id');
    }
}
