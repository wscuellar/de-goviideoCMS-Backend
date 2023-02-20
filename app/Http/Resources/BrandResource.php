<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            "store_id" => $this->store_id,
            "image" => $image,
            "status" => $this->status,
            "description" => $this->description,
            "domain" => $this->domain,
            "e_commerce" => $this->e_commerce,
            "collectinos" => $this->whenLoaded('collectinos'),
            "store" => $this->whenLoaded('store'),
            "brandlocation" => $this->whenLoaded('brandlocation'),
            "created_at" => $this->created_at
        ];
    }
}
