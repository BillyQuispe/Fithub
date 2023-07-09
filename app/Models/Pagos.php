<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $collection = "pagos";

    protected $fillable = [
        'cod_usuario',
        'fecha',
        'nro_operacion',
        'monto',
        'estado'
    ];
}
