<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['user_dni','gym_id'];
}
