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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();

            $table->string('modelo_vehiculo',50);
            $table->string('marca_vehiculo',50);
            $table->integer('anio');
            $table->string('nombre',20)->nullable();

            $table->unsignedBigInteger('id_tipovehiculo');
            $table->foreign('id_tipovehiculo')->references('id')->on('tipo_vehiculos');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
