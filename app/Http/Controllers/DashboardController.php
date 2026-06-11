<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\PreInscripcion;
use App\Models\Docente;
use App\Models\Grupo;

class DashboardController extends Controller
{
    public function index()
    {
        $periodoActivo = Periodo::where('activo', true)->first();

        $postulantes = 0;
        $docentes = 0;
        $grupos = 0;

        if ($periodoActivo) {

            $postulantes = PreInscripcion::where('periodo_id', $periodoActivo->id)->count();

            $docentes = Docente::whereHas('clases.grupo', function ($q) use ($periodoActivo) {
                $q->where('periodo_id', $periodoActivo->id);
            })->count();

            $grupos = Grupo::where('periodo_id', $periodoActivo->id)->count();
        }

        return view('dashboard', compact(
            'postulantes',
            'docentes',
            'grupos'
        ));
    }
}