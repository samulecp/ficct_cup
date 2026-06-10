<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\User;
use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Postulante;
use App\Models\PreInscripcion;
use App\Services\LogService;
use Illuminate\Http\Request;

class PreInscripcionController extends Controller
{
   public function index(Request $request)
{
    $buscar = $request->buscar;

    $preinscripciones = PreInscripcion::with([
        'postulante',
        'carreraPrimera',
        'carreraSegunda',
        'periodo',
        'grupo'
    ])

    ->when($buscar, function ($query) use ($buscar) {

        $query->whereHas('postulante', function ($q) use ($buscar) {

            $q->where('nombre', 'ILIKE', "%{$buscar}%")
              ->orWhere('ci', 'ILIKE', "%{$buscar}%");

        });

    })

    ->get();

    return view(
        'preinscripciones.index',
        compact('preinscripciones')
    );
}

    public function create()
    {
        $periodos = Periodo::where(
            'activo',
            true
        )->get();

        $carreras = Carrera::all();

        return view(
            'preinscripciones.create',
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

            'periodo_id' =>
                'required|exists:periodos,id',

            'carrera_primera_id' =>
                'required|exists:carreras,id',

            'carrera_segunda_id' =>
                'required|exists:carreras,id',
        ]);

        $periodo = Periodo::findOrFail(
            $request->periodo_id
        );

        if (!$periodo->activo) {

            return back()
                ->withErrors([
                    'periodo_id' =>
                    'El periodo seleccionado no está activo.'
                ])
                ->withInput();
        }

        $postulante = Postulante::where(
            'ci',
            $request->ci
        )->first();

        /*
        |--------------------------------------------------------------------------
        | Crear usuario y postulante si no existe
        |--------------------------------------------------------------------------
        */

        if (!$postulante) {

            if (
                User::where(
                    'email',
                    $request->correo
                )->exists()
            ) {

                return back()
                    ->withErrors([
                        'correo' =>
                        'Ya existe un usuario con ese correo.'
                    ])
                    ->withInput();
            }

            $user = User::create([

                'name' =>
                    $request->nombre,

                'email' =>
                    $request->correo,

                'password' =>
                    bcrypt($request->ci),

                'estado' => true,
            ]);

            $user->assignRole(
                'postulante'
            );

            $postulante = Postulante::create([

                'user_id' =>
                    $user->id,

                'ci' =>
                    $request->ci,

                'extension' =>
                    $request->extension,

                'nombre' =>
                    $request->nombre,

                'correo' =>
                    $request->correo,

                'telefono' =>
                    $request->telefono,

                'rude' =>
                    $request->rude,
            ]);

            LogService::registrar(
                'CREAR',
                'POSTULANTES',
                'Se registró el postulante: '
                . $postulante->nombre
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Verificar preinscripción duplicada
        |--------------------------------------------------------------------------
        */

        $existe = PreInscripcion::where(
            'postulante_id',
            $postulante->id
        )
        ->where(
            'periodo_id',
            $request->periodo_id
        )
        ->exists();

        if ($existe) {

            return back()
                ->withErrors([
                    'ci' =>
                    'El postulante ya tiene una preinscripción en este periodo.'
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Crear preinscripción
        |--------------------------------------------------------------------------
        */

        $preinscripcion =
            PreInscripcion::create([

                'postulante_id' =>
                    $postulante->id,

                'grupo_id' => null,

                'periodo_id' =>
                    $request->periodo_id,

                'carrera_primera_id' =>
                    $request->carrera_primera_id,

                'carrera_segunda_id' =>
                    $request->carrera_segunda_id,
            ]);

        LogService::registrar(
            'CREAR',
            'PREINSCRIPCIONES',
            'Preinscripción registrada para CI: '
            . $postulante->ci
        );

       

        return redirect()
            ->route(
                'preinscripciones.index'
            )
            ->with(
                'success',
                'Preinscripción registrada correctamente.'
            );
    }

    public function show(
        PreInscripcion $preinscripcion
    ) {
        return view(
            'preinscripciones.show',
            compact('preinscripcion')
        );
    }
}