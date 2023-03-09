<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            "name" => $this->name,
            "description" => $this->description,
            "email" => $this->email,
            "phone" => $this->phone,
            "address" => $this->address,
            "address_2" => $this->address_2,
            "country_id" => $this->country_id,
            "state_id" => $this->state_id,
            "city_id" => $this->city_id,
            "zip_code" => $this->zip_code,
            "status" => $this->status,
            "store_id" => $this->store_id,
            "stores" => $this->whenLoaded('stores'),
            "locationbrand" => $this->whenLoaded('locationbrand'),
            "created_at" => $this->created_at
        ];
    }
}
