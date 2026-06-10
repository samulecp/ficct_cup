<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultadoAcademico extends Model
{
    protected $fillable = [
        'pre_inscripcion_id',
        'promedio',
        'estado',
        'carrera_id'
    ];

    public function preinscripcion()
{
    return $this->belongsTo(
        PreInscripcion::class,
        'pre_inscripcion_id'
    );
}

    public function carrera()
    {
        return $this->belongsTo(
            Carrera::class
        );
    }
}
