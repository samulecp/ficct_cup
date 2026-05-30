<?php


use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PostulanteController;
use App\Http\Controllers\PreInscripcionController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

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

    });

// OPERADOR
Route::middleware(['auth', 'role:operador'])
    ->prefix('operador')
    ->name('operador.')
    ->group(function () {
        Route::get('/dashboard', [OperadorController::class, 'index'])
            ->name('dashboard');

        
    });

// DOCENTE
Route::middleware(['auth', 'role:docente'])
    ->prefix('docente')
    ->name('docente.')
    ->group(function () {
        Route::get('/dashboard', [DocenteController::class, 'index'])
            ->name('dashboard');
    });

// POSTULANTE
Route::middleware(['auth', 'role:postulante'])
    ->prefix('postulante')
    ->name('postulante.')
    ->group(function () {
        Route::get('/dashboard', [PostulanteController::class, 'index'])
            ->name('dashboard');
    });

//admin
Route::middleware(['auth', 'role:administrador'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdministradorController::class, 'index'])
            ->name('dashboard');

        Route::resource('carreras', CarreraController::class);

       // Route::resource('usuarios', UsuarioController::class);

        Route::resource('operadores', OperadorController::class);

        Route::resource('administradores', AdministradorController::class);

        Route::resource('periodos', PeriodoController::class);
        Route::patch(
            'periodos/{periodo}/estado',
            [PeriodoController::class, 'cambiarEstado']
        )->name('periodos.estado');

        Route::resource('grupos', GrupoController::class);

        

        Route::get(
            'logs',
            [LogController::class, 'index']
        )->name('logs.index');

        
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
