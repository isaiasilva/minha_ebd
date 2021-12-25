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
        $this->hasMany(User::class);
    }

    public function turmas()
    {
        $this->hasMany(Turma::class);
    }
}
