<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Jenssegers\Mongodb\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['nombre','precio','sessions'];

    public function users()
{
    return $this->hasMany(User::class);
}

public function pago()
{
    return $this->hasOne(Pago::class);
}


}
