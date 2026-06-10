<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $fillable = [
        'user_id',
        'ci',
        'telefono',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}