<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoHerramienta extends Model
{
    protected $table = 'tipos_herramientas';

    public $timestamps = true;

    protected $fillable = [
        'tipo_herramienta',
        'cantidad',
    ];

    public function herramientas()
    {
        return $this->hasMany(Herramienta::class, 'id_tipoherramienta');
    }
}
