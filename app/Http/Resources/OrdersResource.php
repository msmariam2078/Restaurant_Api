<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MenuResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'uuid'=>$this->uuid,
            'customer_name'=>$this->user->name,
          
            'ordered_items'=>MenuResource::collection($this->menus),
            'total_cost'=>$this->total_cost."$"

      
      
              ];
    }
}
