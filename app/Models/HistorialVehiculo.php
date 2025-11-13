<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialVehiculo extends Model
{
    use HasFactory;
    protected $table = 'historial_vehiculos';
    protected $fillable = [
        'vehiculo_id',
        'tipo_evento',
        'fecha',
        'descripcion',
        'usuario_id',
        'reporte_id',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'reporte_id');
    }
}
