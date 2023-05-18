<?php

namespace App\Models\Material;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'caminho_arquivo'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
