<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    protected $fillable = ['zona_id','nombre','descripcion','es_amenidad'];

    protected $table = 'propiedades';

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function residente() // si es 1 a 1
    {
        return $this->hasOne(Residente::class);
    }
}
