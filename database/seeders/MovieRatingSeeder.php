<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\MovieRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::all()->each(function (Movie $movie) {
            $totalReviews = rand(20, 50);

            MovieRating::factory()
                ->count($totalReviews)
                ->create([
                    'movie_id' => $movie->id,
                ]);

            $stats = MovieRating::where('movie_id', $movie->id)
                ->selectRaw('AVG(rating) as avg_rating, COUNT(*) as total_people')
                ->first();


            $movie->update([
                'rating' => round($stats->avg_rating, 1),
                'total_rating_people' => $stats->total_people,
            ]);
        });
    }
}
