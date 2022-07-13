<?php

namespace App\Http\Resources;

use App\Models\Food;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $foodList = Food::where("cateId", $this->id)->get();
        return [
            "id" => $this->id,
            "name" => $this->name,
            "foodList" => new FoodCollection($foodList)
        ];
    }
}
