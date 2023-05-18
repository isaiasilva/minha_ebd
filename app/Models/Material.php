<?php

namespace App\Models;

use App\Models\Material\Arquivo;
use App\Models\Material\LinkExterno;
use App\Models\Material\Texto;
use App\Models\Material\YouTube;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'publicar_em', 'user_id', 'igreja_id', 'material_global'];

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class);
    }

    public function you_tubes()
    {
        return $this->hasMany(YouTube::class);
    }

    public function links_externos()
    {
        return $this->hasMany(LinkExterno::class);
    }

    public function textos()
    {
        return $this->hasMany(Texto::class);
    }
}
