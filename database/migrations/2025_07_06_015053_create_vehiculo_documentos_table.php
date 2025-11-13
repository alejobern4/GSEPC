<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vehiculo_documentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detallevehiculo');
            $table->string('nombre');
            $table->date('fecha');
            $table->string('ruta');
            $table->timestamps();

            $table->foreign('id_detallevehiculo')->references('id')->on('detalle_vehiculos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('vehiculo_documentos');
    }
};
