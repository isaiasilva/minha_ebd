<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function muitoRuim()
    {
        return new Attribute(fn () => $this->material()->sum('muito_ruim'));
    }

    public function ruim()
    {
        return new Attribute(fn () => $this->material()->sum('ruim'));
    }

    public function razoavel()
    {
        return new Attribute(fn () => $this->material()->sum('razoavel'));
    }

    public function muitoBom()
    {
        return new Attribute(fn () => $this->material()->sum('muito_bom'));
    }

    public function excelente()
    {
        return new Attribute(fn () => $this->material()->sum('excelente'));
    }
}
