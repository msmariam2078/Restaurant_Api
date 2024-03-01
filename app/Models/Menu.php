<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
       'uuid',
        'item_id',
        'price',
        'restaurant_id',
        
    ];

    public function item()
    {
     return $this->belongsTo(Item::class);

    }
    public function restaurant()
    {
     return $this->belongsTo(Restaurant::class);

    }
}
