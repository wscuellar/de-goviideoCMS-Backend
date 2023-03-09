<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandLocationResource extends JsonResource
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
            "brand_id" => $this->brand_id,
            "location_id" => $this->location_id,
            "brand_name" => $this->brands->name,
            "location_name" => $this->locations->name,
            "created_at" => $this->created_at,
            //"brands" => $this->whenLoaded('brands'),
            //"locations" => $this->whenLoaded('locations')

        ];
    }
}
