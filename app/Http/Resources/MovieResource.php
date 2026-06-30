<?php

namespace App\Http\Resources;

use App\Http\Resources\MovieRatingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'release_date' => $this->release_date->format('Y-m-d'),
            'classification' => $this->classification,
            'rating' => $this->rating,
            'total_rating_people' => $this->total_rating_people,
            'genre' => $this->genre,
            'synopsis' => $this->synopsis,
            'director' => $this->director,
            'writers' => $this->writers,
            'poster_url' => $this->poster_url,
            'trailer_url' => $this->trailer_url,
            'movie_reviews' => MovieRatingResource::collection($this->whenLoaded('movieRatings')),
        ];
    }
}
