<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $path_base = env('APP_URL');

        return [
            "id" => $this->id,
            "uuid" => $this->uuid,
            "type" => $this->type,
            "status" => 1,
            "name" => $this->name,
            "attribute" => $this->attribute,
            "icon" => ($this->icon) ? $path_base.'/'.$this->icon : null,
            "url" => $path_base.'/'.$this->url
        ];
    }
}
