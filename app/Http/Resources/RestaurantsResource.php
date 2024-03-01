<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MenusResource;
class RestaurantsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
      'uuid'=>$this->uuid,
      'name'=>$this->name,
      'cusine_type'=>$this->cusine_type,
      'review'=>$this->review." star",
      'menu'=> MenuResource::collection($this->menus),
     



        ];
    }
}
