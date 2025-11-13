<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoReporte extends Model
{
    protected $table = 'tipo_reportes';

    public $timestamps = true;

    protected $fillable = [
        'tipo_reporte',
        'descripcion',
    ];

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_tiporeporte');
    }
}
