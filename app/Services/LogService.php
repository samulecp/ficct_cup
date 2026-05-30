<?php

namespace App\Services;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogService
{
    public static function registrar(
        $accion,
        $modulo,
        $descripcion
    ) {

        Log::create([

            'user_id' => Auth::id(),

            'accion' => $accion,

            'modulo' => $modulo,

            'descripcion' => $descripcion,

            'ip' => request()->ip(),

            'user_agent' => request()->userAgent(),

        ]);
    }
}