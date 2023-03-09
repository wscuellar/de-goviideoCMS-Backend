<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $path_base = env('APP_URL').'/storage/';
        $image = ($this->image) ? $path_base.$this->image : null;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "url" => $this->url,
            "key" => $this->key,
            "nif_dni" => $this->nif_dni,
            "address" => $this->address,
            "address_2" => $this->address_2,
            "timezone" => $this->timezone,
            "country_id" => $this->country_id,
            "state_id" => $this->state_id,
            "city_id" => $this->city_id,
            "zip_code" => $this->zip_code,
            "image" => $image,
            "status" => $this->status,
            "users" => $this->whenLoaded('users'),
            "brands" => $this->whenLoaded('brands'),
            "created_at" => $this->created_at
        ];
    }
}
