<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('historial_vehiculos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('tipo_evento'); // mantenimiento, soat, tecnomecanica, prestamo, devolucion, etc.
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('reporte_id')->nullable();
            $table->timestamps();

            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('reporte_id')->references('id')->on('reportes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_vehiculos');
    }
};
