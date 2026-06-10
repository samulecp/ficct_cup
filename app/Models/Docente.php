<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $fillable = [
        'user_id',
        'ci',
        'telefono'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clases()
{
    return $this->hasMany(Clase::class);
}
}