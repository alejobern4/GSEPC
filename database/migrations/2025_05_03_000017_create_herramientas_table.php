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
        Schema::create('herramientas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_tipoherramienta');
            $table->foreign('id_tipoherramienta')->references('id')->on('tipo_herramientas');

            $table->unsignedBigInteger('id_estado');
            $table->foreign('id_estado')->references('id')->on('estados');

            $table->unsignedBigInteger('id_estadoregistro');
            $table->foreign('id_estadoregistro')->references('id')->on('estado_registros');

            $table->text('especificacion_herramienta',255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herramientas');
    }
};
