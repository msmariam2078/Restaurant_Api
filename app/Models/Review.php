<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'restaurant_id',
        'user_id',
        'review'
    ];


    protected $casts = [
        'restaurant_id' => 'integer',
        'user_id'=>'integer',
        'review'=>'integer',
         
         

    ];

    public function restaurant()
    {
    return $this->belongsTo(Restaurant::class);

    }
    public function user()
    {
    return $this->belongsTo(User::class);

    }







}
