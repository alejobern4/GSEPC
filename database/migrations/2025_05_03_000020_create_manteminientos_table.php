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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_detallevehiculo');
            $table->foreign('id_detallevehiculo')->references('id')->on('detalle_vehiculos');

            $table->date('fecha_mantenimiento');

            $table->unsignedBigInteger('id_tipomantenimiento');
            $table->foreign('id_tipomantenimiento')->references('id')->on('tipo_mantenimientos');
            $table->string('detalles_mantenimiento', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
