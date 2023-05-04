<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'publicar_em', 'user_id', 'igreja_id', 'material_global'];
}
