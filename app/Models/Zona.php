<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion'];

    public function propiedades()
    {
        return $this->hasMany(Propiedad::class);
    }

    public function guardias()
    {
        return $this->hasMany(Guardia::class);
    }
}
