<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = [
        'nombre',
        'capacidad',
        'estado'
    ];

    public function clases()
{
    return $this->hasMany(Clase::class);
}
}