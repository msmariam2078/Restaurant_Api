<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'uuid'=>$this->uuid,
            'restaurant_namuser->e'=>$this->restaurant->name,
            'user_name'=>$this->user->name,
            'review'=>$this->review
      
      
      
              ];
    }
}
