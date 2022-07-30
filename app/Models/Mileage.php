<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
{
    use HasFactory;

    //Relacion 1 a N Inversa
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
