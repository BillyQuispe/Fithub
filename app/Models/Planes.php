<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Planes extends Model
{
    use HasFactory;

    protected $collection = "planes";

    protected $fillable = [
        'name',
        'description',
        'preci',
        'cupones' 
    ];

}
