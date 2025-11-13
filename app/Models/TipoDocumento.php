<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documentos';

    public $timestamps = true;

    protected $fillable = [
        'tipo_documento',
    ];

    public function personas()
    {
        return $this->hasMany(User::class, 'id_tipdocumento');
    }
}
