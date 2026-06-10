<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Postulacion;
use App\Models\Postulante;
use App\Models\PreInscripcion;
use App\Models\User;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{


    public function index()
{
    $postulaciones = Postulacion::with('periodo', 'carreraPrimera', 'carreraSegunda')
        ->latest()
        ->get();

    return view('postulaciones.index', compact('postulaciones'));
}


public function show(Postulacion $postulacion)
{
    return view('postulaciones.show', compact('postulacion'));
}
    public function create()
    {
        $periodos = Periodo::where(
            'activo',
            true
        )->get();

        $carreras = Carrera::all();

        return view(
            'postulaciones.create',
            compact(
                'periodos',
                'carreras'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'ci' => 'required',

            'nombre' => 'required',

            'correo' => 'required|email',

            'periodo_id' => 'required',

            'carrera_primera_id' => 'required',

            'carrera_segunda_id' => 'required',

            'foto_ci' =>
                'required|file',

            'titulo_bachiller' =>
                'required|file',

            'certificado_nacimiento' =>
                'required|file',
        ]);

        $fotoCi =
            $request
                ->file('foto_ci')
                ->store(
                    'documentos',
                    'public'
                );

        $titulo =
            $request
                ->file('titulo_bachiller')
                ->store(
                    'documentos',
                    'public'
                );

        $certificado =
            $request
                ->file('certificado_nacimiento')
                ->store(
                    'documentos',
                    'public'
                );
$postulacion = Postulacion::create([
    'ci' => $request->ci,
    'extension' => $request->extension,
    'nombre' => $request->nombre,
    'correo' => $request->correo,
    'telefono' => $request->telefono,
    'rude' => $request->rude,
    'periodo_id' => $request->periodo_id,
    'carrera_primera_id' => $request->carrera_primera_id,
    'carrera_segunda_id' => $request->carrera_segunda_id,
    'foto_ci' => $fotoCi,
    'titulo_bachiller' => $titulo,
    'certificado_nacimiento' => $certificado,
    'estado_pago' => 'PENDIENTE',
    'estado_revision' => 'PENDIENTE'
]);

return view(
    'postulaciones.paypal',
    compact('postulacion')
);
    }



    public function confirmarPago(Postulacion $postulacion)
{
    $postulacion->update([
        'estado_pago' => 'PAGADO'
    ]);

    return view(
        'postulaciones.pago-exitoso',
        compact('postulacion')
    );
}



public function cambiarEstado(Request $request, Postulacion $postulacion)
{
    $request->validate([
        'estado_revision' => 'required|in:APROBADO,RECHAZADO'
    ]);

    $postulacion->update([
        'estado_revision' => $request->estado_revision
    ]);

    if ($request->estado_revision === 'APROBADO') {

        // 1. crear usuario si no existe
        $user = User::firstOrCreate(
            ['email' => $postulacion->correo],
            [
                'name' => $postulacion->nombre,
                'password' => bcrypt($postulacion->ci),
                'estado' => true,
            ]
        );

        $user->assignRole('postulante');

        // 2. crear postulante si no existe
        $postulante = Postulante::firstOrCreate(
            ['ci' => $postulacion->ci],
            [
                'user_id' => $user->id,
                'nombre' => $postulacion->nombre,
                'correo' => $postulacion->correo,
                'telefono' => $postulacion->telefono,
                'rude' => $postulacion->rude,
            ]
        );

        // 3. crear preinscripción
        PreInscripcion::firstOrCreate(
            [
                'postulante_id' => $postulante->id,
                'periodo_id' => $postulacion->periodo_id,
            ],
            [
                'carrera_primera_id' => $postulacion->carrera_primera_id,
                'carrera_segunda_id' => $postulacion->carrera_segunda_id,
            ]
        );
    }

    return redirect()
        ->route('postulaciones.index')
        ->with('success', 'Estado actualizado');
}
}