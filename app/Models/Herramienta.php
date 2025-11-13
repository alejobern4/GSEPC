<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    use HasFactory;

    protected $table = 'herramientas';
    public $timestamps = true;

    protected $fillable = [
        'id_tipoherramienta',
        'id_estado',
        'id_estadoregistro',
        'especificacion_herramienta',
    ];

    public function tipoHerramienta()
    {
        return $this->belongsTo(TipoHerramienta::class, 'id_tipoherramienta');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }

    public function estadoRegistro()
    {
        return $this->belongsTo(EstadoRegistro::class, 'id_estadoregistro');
    }

    public function prestamos()
    {
        return $this->hasMany(PrestamoHerramienta::class, 'id_herramienta');
    }
}
