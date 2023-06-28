<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $fillable = ['user_id','plan_id','voucher'];
    
    public function plan()
{
    return $this->belongsTo(Plan::class);
}

}
