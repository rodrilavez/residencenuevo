<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mensaje'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 