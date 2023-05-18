<?php

namespace App\Models\Material;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LinkExterno extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'url'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
