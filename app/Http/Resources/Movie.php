<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Genre;

class Movie extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'year' => $this->year,
            'synopsis' => $this->synopsis,
            'minutes' => $this->minutes,
            'released_at' => $this->releasead_at,
            'cost' => $this->cost,
            'genres' => Genre::collection($this->genres)

        ];
    }
}
