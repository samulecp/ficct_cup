<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreInscripcion extends Model
{
    protected $table = 'pre_inscripciones';

    protected $fillable = [

    'postulante_id',
    'grupo_id',
    'carrera_primera_id',
    'carrera_segunda_id',
    'periodo_id',

    'foto_ci',
    'titulo_bachiller',
    'certificado_nacimiento',

    'estado_pago',
    'estado_revision'
];

    public function postulante()
{
    return $this->belongsTo(Postulante::class, 'postulante_id');
}

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function carreraPrimera()
    {
        return $this->belongsTo(
            Carrera::class,
            'carrera_primera_id'
        );
    }

    public function carreraSegunda()
    {
        return $this->belongsTo(
            Carrera::class,
            'carrera_segunda_id'
        );
    }

    public function calificaciones()
{
    return $this->hasMany(
        Calificacion::class,
        'pre_inscripcion_id'
    );

    
}
public function resultadoAcademico()
{
    return $this->hasOne(
        ResultadoAcademico::class
    );
}
}