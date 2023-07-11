<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $collection = "pagos";

    protected $fillable = [
        'id_usuario',
        'fecha',
        'nro_operacion',
        'monto',
        'estado',
        'foto',
    ];

    public function usuarios()
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }

}
