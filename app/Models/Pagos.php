<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $collection = "pagos";

    protected $fillable = [
<<<<<<< HEAD
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

=======
        'cod_usuario',
        'fecha',
        'nro_operacion',
        'monto',
        'estado'
    ];
>>>>>>> 89b1880174201d7e73f199fe1afcb3605f54f880
}
