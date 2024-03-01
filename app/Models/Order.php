<?php

namespace App\Models;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'user_id',
        'order_type',
        'total_cost'
    ];


    protected $casts = [
          
        'user_id'=>'integer',
        'order_type'=>'string',
         'total_cost'=>'double'
         

    ];

    public function user()
    {
    return $this->belongsTo(User::class);

    }
    // public function restaurant()
    // {
    // return $this->belongsTo(Restaurant::class);

    // }
    // public function menus()
    // {
    // return $this->hasMany(Menu::class);

    // }
    public function menus()
    {
    return $this->belongsToMany(Menu::class,'item_orders');

    }
    public function item_orders()
    {
    return $this->hasMany(Item_order::class);

    }

}
