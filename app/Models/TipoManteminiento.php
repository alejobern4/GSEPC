<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMantenimiento extends Model
{
    protected $table = 'tipo_mantenimientos';

    public $timestamps = true;

    protected $fillable = [
        'mantenimiento',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'id_tipomantenimiento');
    }
}
