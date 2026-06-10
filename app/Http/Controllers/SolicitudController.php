<?php

namespace App\Http\Controllers;

use App\Models\Postulante;
use App\Models\PreInscripcion;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function store(Request $request)
{
    $request->validate([

        'ci'=>'required',

        'nombre'=>'required',

        'correo'=>'required|email',

        'foto_ci'=>'required|file',

        'titulo_bachiller'=>'required|file',

        'periodo_id'=>'required',

        'carrera_primera_id'=>'required',

        'carrera_segunda_id'=>'required',
    ]);

    Solicitud::create([

        'ci'=>$request->ci,

        'extension'=>$request->extension,

        'nombre'=>$request->nombre,

        'correo'=>$request->correo,

        'telefono'=>$request->telefono,

        'rude'=>$request->rude,

        'periodo_id'=>$request->periodo_id,

        'carrera_primera_id'=>$request->carrera_primera_id,

        'carrera_segunda_id'=>$request->carrera_segunda_id,

        'foto_ci'=>
            $request->file('foto_ci')
                ->store('solicitudes'),

        'titulo_bachiller'=>
            $request->file('titulo_bachiller')
                ->store('solicitudes'),

        'estado_pago'=>'PAGADO',

        'estado_revision'=>'PENDIENTE'
    ]);

    return back()
        ->with(
            'success',
            'Solicitud enviada correctamente'
        );


}

public function aprobar(Solicitud $solicitud)
{
    $user = User::create([

        'name'=>$solicitud->nombre,

        'email'=>$solicitud->correo,

        'password'=>bcrypt($solicitud->ci),

        'estado'=>true
    ]);

    $user->assignRole('postulante');

    $postulante = Postulante::create([

        'user_id'=>$user->id,

        'ci'=>$solicitud->ci,

        'extension'=>$solicitud->extension,

        'nombre'=>$solicitud->nombre,

        'correo'=>$solicitud->correo,

        'telefono'=>$solicitud->telefono,

        'rude'=>$solicitud->rude
    ]);

    PreInscripcion::create([

        'postulante_id'=>$postulante->id,

        'grupo_id'=>null,

        'periodo_id'=>$solicitud->periodo_id,

        'carrera_primera_id'=>
            $solicitud->carrera_primera_id,

        'carrera_segunda_id'=>
            $solicitud->carrera_segunda_id
    ]);

    $solicitud->update([
        'estado_revision'=>'APROBADO'
    ]);

    return back();
}

}
