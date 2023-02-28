<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Igreja extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'endereco', 'pastor', 'tipo_igreja', 'dia_ebd', 'horario'];
}
