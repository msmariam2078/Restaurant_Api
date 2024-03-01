<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',

      
        'descreption',
        
    ];


    protected $casts = [
        'name' => 'string',
        
        'descreption'=>'string',
        
         

    ];

    public function restaurants()
    {
    return $this->belongsToMany(Restaurant::class,'Item_restaurants');

    }



}
