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
        Schema::create('postulantes', function (Blueprint $table) {

    $table->id();

    $table->foreignId('user_id')
        ->nullable()
        ->constrained()
        ->onDelete('cascade');

    $table->string('ci')->unique();
    $table->string('extension', 10)->nullable();

    $table->string('nombre');

    $table->string('correo')->unique();

    $table->string('telefono', 20)->nullable();

    $table->string('rude')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantes');
    }
};
