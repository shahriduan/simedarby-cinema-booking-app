<?php

namespace App\Http\Resources;

use App\Http\Resources\MovieRatingResource;
use Carbon\CarbonInterval;
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
            'release_date' => $this->release_date->format('d M Y'),
            'duration' => CarbonInterval::minutes($this->duration_minutes)->cascade()->forHumans(['short' => true, 'parts' => 2, ]),
            'classification' => $this->classification,
            'rating' => $this->rating,
            'total_rating_people' => $this->total_rating_people,
            'genre' => $this->genre,
            'synopsis' => $this->synopsis,
            'director' => $this->director,
            'writers' => $this->writers,
            'casts' => $this->casts,
            'poster_url' => $this->poster_url,
            'trailer_url' => $this->trailer_url,
            'movie_reviews' => MovieRatingResource::collection(
                $this->whenLoaded('movieRatings', function () {
                    return $this->movieRatings->take(5);
                })
            ),
            'rating_breakdown' => $this->whenLoaded('movieRatings', function () {
                return collect([5, 4, 3, 2, 1])->map(function ($stars) {
                    return [
                        'stars' => $stars,
                        'count' => $this->movieRatings->where('rating', $stars)->count(),
                    ];
                })->toArray();
            }),
        ];
    }
}
