<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['guardia_id','inicio','fin'];

    protected $dates = ['inicio','fin'];

    public function guardia()
    {
        return $this->belongsTo(Guardia::class);
    }
}
