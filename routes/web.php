<?php


use App\Http\Controllers\SolicitudAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\PreInscripcionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ResultadoAcademicoController;

use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [PostulacionController::class,'create']
)->name('postulacion.create');

Route::post(
    '/postulacion',
    [PostulacionController::class,'store']
)->name('postulacion.store');



Route::post(
    '/postulacion/pagar/{postulacion}',
    [PostulacionController::class,'confirmarPago']
)->name('postulacion.pagar');





Route::get('/login', function () {
    return redirect()->route('login');
});



//dashboard para todos
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');



Route::resource(
    'calificaciones',
    CalificacionController::class
)->parameters([
    'calificaciones' => 'calificacion'
]);


//operador-admin
Route::middleware(['auth', 'role:administrador|operador'])
    ->group(function () {

        Route::resource(
            'preinscripciones',
            PreInscripcionController::class
        )->only([
            'index',
            'create',
            'store'
        ]);
        Route::resource('postulante', PostulanteController::class);
        Route::resource('grupos', GrupoController::class);
        Route::resource('clases', ClaseController::class);
        Route::resource('horarios', HorarioController::class);

        Route::post(
    '/grupos/asignar-automaticamente',
    [GrupoController::class,
     'asignarAutomaticamente']
)->name(
    'grupos.asignarAutomaticamente'
);
Route::get('/reportes', [ReporteController::class, 'index'])
    ->name('reportes.index');   
Route::get('/reportes/pdf', [ReporteController::class, 'pdf'])
    ->name('reportes.pdf');

Route::post(
    '/calificaciones/generar',
    [CalificacionController::class, 'generar']
)->name('calificaciones.generar');
   

Route::get('/postulaciones', [PostulacionController::class, 'index'])
    ->name('postulaciones.index');

Route::get('/postulaciones/{postulacion}', [PostulacionController::class, 'show'])
    ->name('postulaciones.show');

Route::post('/postulaciones/{postulacion}/estado', [PostulacionController::class, 'cambiarEstado'])
    ->name('postulaciones.estado');

});



// OPERADOR
Route::middleware(['auth', 'role:operador'])
    ->prefix('operador')
    ->name('operador.')
    ->group(function () {});

// DOCENTE
Route::middleware(['auth', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')
    ->group(function () {

        Route::resource(
    'calificaciones',
    CalificacionController::class
)->parameters([
    'calificaciones' => 'calificacion'
]);
        Route::get(
            '/mis-clases',
            [CalificacionController::class, 'misClases']
        )->name('misClases');

        Route::get(
            '/mis-calificaciones',
            [CalificacionController::class, 'misClasesCalificacion']
        )->name('misCalificaciones');

        Route::get(
            '/mis-calificaciones/{clase}',
            [CalificacionController::class, 'calificarClase']
        )->name('calificarClase');
    });

// POSTULANTE
Route::middleware(['auth', 'role:postulante'])
    ->prefix('postulante')
    ->name('postulante.')
    ->group(function () {

     Route::get(
            '/mis-clases',
            [PostulanteController::class,'misClases']
        )->name('misClases');

        Route::get(
            '/mis-calificaciones',
            [PostulanteController::class,'misCalificaciones']
        )->name('misCalificaciones');

    });

//admin
Route::middleware(['auth', 'role:administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        
       
        
        Route::resource('carreras', CarreraController::class);

        Route::resource('usuarios', UserController::class);

        Route::resource('operadores', OperadorController::class)
            ->parameters([
                'operadores' => 'operador'
            ]);

        Route::resource('administradores', AdministradorController::class);

        Route::resource('periodos', PeriodoController::class);
        Route::patch(
            'periodos/{periodo}/estado',
            [PeriodoController::class, 'cambiarEstado']
        )->name('periodos.estado');

        Route::resource('grupos', GrupoController::class);
        Route::resource('docentes', DocenteController::class);


        Route::get(
            'logs',
            [LogController::class, 'index']
        )->name('logs.index');

        Route::resource('aulas', AulaController::class);
        Route::resource('materias', MateriaController::class);
        Route::get(
    '/resultados-academicos',
    [ResultadoAcademicoController::class, 'index']
)->name('resultados.index');

Route::post(
    '/resultados-academicos/generar',
    [ResultadoAcademicoController::class, 'generar']
)->name('resultados.generar');

        Route::post(
    '/resultados-academicos/asignar-carreras',
    [ResultadoAcademicoController::class,
    'asignarCarreras']
)->name(
    'resultados.asignarCarreras'
);


    });


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});





require __DIR__ . '/auth.php';
