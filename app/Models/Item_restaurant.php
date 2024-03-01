<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        
        'restaurant_id',
        
    ];
}
