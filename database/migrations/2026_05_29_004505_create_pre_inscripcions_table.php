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
        Schema::create('pre_inscripciones', function (Blueprint $table) {

    $table->id();

    $table->foreignId('postulante_id')
        ->constrained()
        ->onDelete('cascade');

    $table->foreignId('grupo_id')
    ->nullable()
    ->constrained()
    ->nullOnDelete();

    $table->foreignId('carrera_primera_id')
        ->constrained('carreras');

    $table->foreignId('carrera_segunda_id')
        ->constrained('carreras');
        $table->foreignId('periodo_id')
      ->constrained();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_inscripcions');
    }
};
