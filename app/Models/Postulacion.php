<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
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
        'certificado_nacimiento',

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