<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'number',
        'order_id',
        
    ];


    protected $casts = [
        'menu_id' => 'integer',
        'number'=>'integer',
        'order_id'=>'integer',
        
         

    ];
    public function menu()
    {
     return $this->belongsTo(Menu::class);

    }
    public function order()
    {
     return $this->belongsTo(Order::class);

    }

}
