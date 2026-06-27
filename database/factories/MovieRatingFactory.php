<?php

namespace Database\Factories;

use App\Models\MovieRating;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MovieRating>
 */
class MovieRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reviews = [
            'Amazing movie from start to finish.',
            'Great action scenes and story.',
            'Worth watching in cinema.',
            'Good movie but pacing was a bit slow.',
            'Excellent cast performance.',
            'Visual effects were impressive.',
            'The ending was unexpected.',
            'One of the best movies this year.',
            'Could have been better.',
            'Highly recommended.',
        ];

        $rating = fake()->numberBetween(2, 5);

        $reviewTitle = ($rating >= 3) 
            ? fake()->randomElement($reviews) 
            : fake()->sentence(3);

        $reviewContent = fake()->sentences(3, true); 

        return [
            'name' => fake()->name(),
            'rating' => $rating,
            'review_title' => $reviewTitle,
            'review_content' => $reviewContent,
        ];
    }
}
