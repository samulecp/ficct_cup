<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operador extends Model
{

 protected $table = 'operadores'; 
    protected $fillable = [
        'user_id',
        'ci',
        'nombre',
        'correo',
        'telefono',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
