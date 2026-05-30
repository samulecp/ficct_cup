<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model
{
    protected $fillable = [
        'user_id',
        'ci',
        'extension',
        'nombre',
        'correo',
        'telefono',
        'rude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App\Models\Postulante.php

public function preinscripciones()
{
    return $this->hasMany(PreInscripcion::class);
}
}