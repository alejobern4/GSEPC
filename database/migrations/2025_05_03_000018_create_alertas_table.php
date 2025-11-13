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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('id_detallevehiculo');
            $table->foreign('id_detallevehiculo')->references('id')->on('detalle_vehiculos');
            
            $table->string('email_alerta', 100);

            $table->unsignedBigInteger('id_tipoalerta');
            $table->foreign('id_tipoalerta')->references('id')->on('tipo_alertas');

            $table->unsignedBigInteger('id_estadoregistro');
            $table->foreign('id_estadoregistro')->references('id')->on('estado_registros');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};
