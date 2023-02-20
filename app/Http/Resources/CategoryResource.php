<?php

namespace App\Http\Resources;

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
        return [
            "id" => $this->id,
            "name" => $this->name,
            "sale_private" => $this->sale_private,
            "symbol_collection" => $this->symbol_collection,
            "store_id" => $this->store_id,
            "store" => $this->whenLoaded('store'),
            "created_at" => $this->created_at
        ];
    }
}
