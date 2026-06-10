<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $fillable = [

        'ci',
        'extension',
        'nombre',
        'correo',
        'telefono',
        'rude',

        'periodo_id',

        'carrera_primera_id',
        'carrera_segunda_id',

        'foto_ci',
        'titulo_bachiller',

        'estado_pago',
        'estado_revision'
    ];

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
}