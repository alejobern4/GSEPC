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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_detallevehiculo');
            $table->foreign('id_detallevehiculo')->references('id')->on('detalle_vehiculos');

            $table->unsignedBigInteger('id_tiporeporte');
            $table->foreign('id_tiporeporte')->references('id')->on('tipo_reportes');

            $table->date('fecha_reporte');

            $table->unsignedBigInteger('reporte_id')->nullable();
            $table->foreign('reporte_id')->references('id')->on('reportes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
