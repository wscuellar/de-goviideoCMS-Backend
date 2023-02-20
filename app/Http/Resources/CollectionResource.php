<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CollectionResource extends JsonResource
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
            "brand_id" => $this->brand_id,
            "category_id" => $this->category_id,
            "image" => $image,
            "description" => $this->description,
            "season" => $this->season,
            "campaign" => $this->campaign,
            "status" => $this->status,
            "is_manufacturing" => $this->is_manufacturing,
            "manufacturing_origin" => $this->manufacturing_origin,
            "is_maketplace" => $this->is_maketplace,
            "release_date" => Carbon::parse($this->release_date)->format('d.m.Y'),
            "presale_date" => Carbon::parse($this->presale_date)->format('d.m.Y'),
            "is_active" => $this->is_active,
            "status" => $this->status,
            "brand" => $this->whenLoaded('brand'),
            "store" => $this->whenLoaded('store'),
            "category" => $this->whenLoaded('category'),
            "created_at" => $this->created_at
        ];
    }
}
