<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Reseñas extends Model
{
    use HasFactory;

    protected $table = 'reseñas';

    protected $fillable = [
        'n_estrellas',
        'description',
        'rol_id',
        'gym_id'
    ];
}
