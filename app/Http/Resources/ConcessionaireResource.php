<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConcessionaireResource extends JsonResource
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
            "description" => $this->description,
            "image" => $image,
            "status" => $this->status,
            "store_id" => $this->store_id,
            "store" => $this->whenLoaded('store'),
            "created_at" => $this->created_at
        ];
    }
}
