<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'material_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'id', 'material_id');
    }
}
