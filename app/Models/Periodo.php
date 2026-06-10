<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $fillable = [
        'nombre',
        'nota_aprobacion',
        'max_alumno_grupo',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];

    public function preinscripciones()
{
    return $this->hasMany(PreInscripcion::class);
}

public function grupos()
{
    return $this->hasMany(Grupo::class);
}
}