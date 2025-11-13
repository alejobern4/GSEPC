<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialHerramienta extends Model
{
    use HasFactory;
    protected $table = 'historial_herramientas';
    protected $fillable = [
        'herramienta_id',
        'tipo_evento',
        'fecha',
        'descripcion',
        'usuario_id',
        'reporte_id',
    ];

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class);
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
