<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','propiedad_id','telefono'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }
}
