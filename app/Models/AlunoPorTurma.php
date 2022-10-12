<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoPorTurma extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'turma_id',
    ];
    protected $appends = ['presenca', 'name'];
    public $timestamps = false;

    public function aluno()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function turma()
    {
        return $this->belongsTo(Turma::class, 'id', 'turma_id');
    }

    public function getPresencaAttribute()
    {
        return Chamada::where(['aluno_id' => $this->id, 'turma_id' => $this->turma_id, 'data' => date('Y-m-d')])->first();
    }

    public function getNameAttribute()
    {
        return User::find($this->id)->name;
    }
}
