<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reportes';

    public $timestamps = true;

    protected $fillable = [
        'id_detallevehiculo',
        'id_tiporeporte',
        'fecha_reporte',
    ];

    public function detalleVehiculo()
    {
        return $this->belongsTo(DetalleVehiculo::class, 'id_detallevehiculo');
    }

    public function tipoReporte()
    {
        return $this->belongsTo(TipoReporte::class, 'id_tiporeporte');
    }

    public function historialVehiculos()
    {
        return $this->hasMany(\App\Models\HistorialVehiculo::class, 'reporte_id');
    }

    public function historialHerramientas()
    {
        return $this->hasMany(\App\Models\HistorialHerramienta::class, 'reporte_id');
    }

    public function reportePadre()
    {
        return $this->belongsTo(self::class, 'reporte_id');
    }

    public function reportesHijos()
    {
        return $this->hasMany(self::class, 'reporte_id');
    }
}
