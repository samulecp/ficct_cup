<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
    'periodo_id',
    'nombre',
];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function clases()
{
    return $this->hasMany(Clase::class);
}

public function preinscripciones()
{
    return $this->hasMany(
        PreInscripcion::class
    );
}

}
