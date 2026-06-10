<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    protected $fillable = [
        'grupo_id',
        'materia_id',
        'horario_id',
        'docente_id',
        'aula_id'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function calificaciones()
{
    return $this->hasMany(
        Calificacion::class
    );
}
}