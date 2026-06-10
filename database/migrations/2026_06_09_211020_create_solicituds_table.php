<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes', function (Blueprint $table) {

    $table->id();

    $table->string('ci');
    $table->string('extension')->nullable();

    $table->string('nombre');
    $table->string('correo');
    $table->string('telefono')->nullable();

    $table->string('rude')->nullable();

    $table->foreignId('periodo_id')
        ->constrained();

    $table->foreignId('carrera_primera_id')
        ->constrained('carreras');

    $table->foreignId('carrera_segunda_id')
        ->constrained('carreras');

    $table->string('foto_ci');
    $table->string('titulo_bachiller');

    $table->enum(
        'estado_pago',
        ['PENDIENTE','PAGADO']
    )->default('PENDIENTE');

    $table->enum(
        'estado_revision',
        [
            'PENDIENTE',
            'APROBADO',
            'RECHAZADO'
        ]
    )->default('PENDIENTE');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicituds');
    }
};
