<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            "id" => $this->id,
            "cateId" => $this->cateId, 
            "name" => $this->name,
            "price" => $this->price,
            "description" => $this->description,
            "ingredients" => $this->ingredients,
            "img" => "http://localhost:8000/images/".$this->img,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at
        ];
    }
}
