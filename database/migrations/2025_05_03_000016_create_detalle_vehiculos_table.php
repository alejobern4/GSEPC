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
        Schema::create('detalle_vehiculos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_vehiculo');
            $table->foreign('id_vehiculo')->references('id')->on('vehiculos');

            $table->unsignedBigInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('personas');

            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estados');

            $table->unsignedBigInteger('id_estadoregistro');
            $table->foreign('id_estadoregistro')->references('id')->on('estado_registros');

            $table->string('placa', 10);
            $table->string('conductor_auxiliar', 100)->nullable();
            $table->date('fecha_solicitud')->nullable();
            $table->date('fecha_devolucion')->nullable();
            $table->date('fecha_soat');
            $table->date('fecha_tecnomecanica');
            $table->binary('imagen_vehiculo')->nullable();
            $table->date('fecha_ultimo_mantenimiento')->nullable();
            $table->string('descripcion_ultimo_mantenimiento', 200)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_vehiculos');
    }
};
