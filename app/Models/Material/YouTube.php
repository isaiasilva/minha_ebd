<?php

namespace App\Models\Material;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouTube extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'url'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
