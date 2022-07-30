<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    public function people()
    {
        return $this->hasOne(Person::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //Relacion 1 a N
    public function cars(){
        return $this->hasMany(Car::class);
    }
}
