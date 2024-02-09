<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tagline' => $this->tagline,
            'first_brewed' => $this->first_brewed,
            'description' => $this->description,
            'abv' => $this->abv,
            'ibu' => $this->ibu,
            'image_url' => $this->image_url,
            'food_pairing' => $this->food_pairing,
        ];
    }
}
