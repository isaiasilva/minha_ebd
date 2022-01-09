<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    use HasFactory;
    protected $fillable = [
        'data',
        'professor_id',
        'turma_id',
        'aluno_id',
        'atraso',
        'material'
    ];

    public $timestamps = false;

    public function aluno()
    {
        return $this->belongsTo(User::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }


}
