<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'muito_ruim',
        'ruim',
        'razoavel',
        'muito_bom',
        'excelente',
        'user_id',
        'material_id',
    ];
}
