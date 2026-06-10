<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones'; 
    protected $fillable = [

        'pre_inscripcion_id',
        'clase_id',
        'examen1',
        'examen2',
        'examen3',
        'nota_final',
    ];

    public function preinscripcion()
    {
        return $this->belongsTo(
            PreInscripcion::class,
            'pre_inscripcion_id'
        );
    }

    public function clase()
{
    return $this->belongsTo(
        Clase::class
    );
}

public function getEstadoAttribute()
{
    $notaMin = $this->preinscripcion->periodo->nota_aprobacion;

    return $this->nota_final >= $notaMin
        ? 'APROBADO'
        : 'REPROBADO';
}
}