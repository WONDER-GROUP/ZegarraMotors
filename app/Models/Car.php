<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    //Relacion 1 a N Inversa
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //Relacion 1 a N
    public function mileages(){
        return $this->hasMany(Mileage::class);
    }
    
    //Relacion 1 a 1 Polimorfica
    public function image(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
