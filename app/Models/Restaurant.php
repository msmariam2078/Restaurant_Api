<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cusine_type',
        'location',
        'phone',
      
    ];


    protected $casts = [
        'uuid',
        'name' => 'string',
        'cusine_type'=>'string',
        'location'=>'string',
         'phone'=>'string',
       

    ];
    protected $appends=['review'];

   public function getReviewAttribute()
   {
    $total=0;
    if($this->reviews->isEmpty()){
     return 0;

    }
    // 
    foreach ($this->reviews as $review)
{   
    $total=$total+$review->review;}
    $avarege= $total/$this->reviews->count();
    return $avarege;
   }

    public function menus()
    {
    return $this->hasMany(Menu::class);

    }
    public function orders()
    {
    return $this->hasMany(Order::class);

    }
    public function reviews()
    {
    return $this->hasMany(Review::class);

    }








}


