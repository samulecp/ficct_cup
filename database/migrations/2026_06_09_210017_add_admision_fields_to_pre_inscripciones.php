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
    Schema::table('pre_inscripciones', function (Blueprint $table) {

        $table->string('foto_ci')->nullable();

        $table->string('titulo_bachiller')->nullable();

        $table->string('certificado_nacimiento')->nullable();

        $table->enum('estado_pago', [
            'PENDIENTE',
            'PAGADO'
        ])->default('PENDIENTE');

        $table->enum('estado_revision', [
            'PENDIENTE',
            'APROBADO',
            'RECHAZADO'
        ])->default('PENDIENTE');
    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
    {
        Schema::table('pre_inscripciones', function (Blueprint $table) {

            $table->dropColumn([
                'foto_ci',
                'titulo_bachiller',
                'certificado_nacimiento',
                'estado_pago',
                'estado_revision'
            ]);
        });
    }
};
