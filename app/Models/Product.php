<?php

namespace App\Models;

use App\Models\Inventory;
use App\Models\Presentation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
