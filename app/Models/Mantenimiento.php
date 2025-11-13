<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'mantenimientos';

    protected $fillable = [
        'id_detallevehiculo',
        'fecha_mantenimiento',
        'id_tipomantenimiento',
        'detalles_mantenimiento',
    ];

    public function detalleVehiculo()
    {
        return $this->belongsTo(DetalleVehiculo::class, 'id_detallevehiculo');
    }

    public function tipoMantenimiento()
    {
        return $this->belongsTo(TipoMantenimiento::class, 'id_tipomantenimiento');
    }
}
