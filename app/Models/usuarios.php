<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;
    protected $collection = "usuarios";

    protected $fillable = [
        'nombre',
        'asistencia'
    ];
}
