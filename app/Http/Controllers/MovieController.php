<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;

/**
 * @group   Movies
 */
class MovieController extends Controller
{
    /**
     * List Movies
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": [
     *         {
     *             "id": 4,
     *             "title": "Masters Of The Universe",
     *             "release_date": "2026-06-04",
     *             "classification": "13",
     *             "rating": "3.3",
     *             "total_rating_people": 46,
     *             "genre": [
     *                 "Action"
     *             ],
     *             "synopsis": "A young man on Earth discovers a fabulous secret legacy as the prince of an alien planet, and must recover a magic sword and return home to protect his kingdom.",
     *             "director": "Travis Knight",
     *             "writers": "Chris Butler, Aaron Nee, Adam Nee",
     *             "poster_url": "https://poster.gsc.com.my/2025/251117_MastersOfTheUniverse_big.jpg",
     *             "trailer_url": "https://youtu.be/Vf_5H3T8Y7Q?si=HOg0l0F5EeMOpMvG"
     *         }
     *     ]
     * }
     */
    public function listMovies(Request $request)
    {
        $movies = Movie::orderBy('title')->get();

        return $this->responseSuccess('OK', MovieResource::collection($movies));
    }

    /**
     * Movie Details
     * 
     * This API include rating and reviews
     * 
     * @response {
     *     "status": true,
     *     "message": "OK",
     *     "data": {
     *         "id": 4,
     *         "title": "Masters Of The Universe",
     *         "release_date": "04 Jun 2026",
     *         "duration": "2h 21m",
     *         "classification": "13",
     *         "rating": "3.6",
     *         "total_rating_people": 47,
     *         "genre": [
     *             "Action"
     *         ],
     *         "synopsis": "A young man on Earth discovers a fabulous secret legacy as the prince of an alien planet, and must recover a magic sword and return home to protect his kingdom.",
     *         "director": "Travis Knight",
     *         "writers": "Chris Butler, Aaron Nee, Adam Nee",
     *         "casts": "Nicholas Galitzine, Morena Baccarin, Idris Elba, James Purefoy, Jared Leto",
     *         "poster_url": "https://poster.gsc.com.my/2025/251117_MastersOfTheUniverse_big.jpg",
     *         "trailer_url": "https://youtu.be/Vf_5H3T8Y7Q?si=HOg0l0F5EeMOpMvG",
     *         "movie_reviews": [
     *             {
     *                 "id": 124,
     *                 "name": "Go Chet Tim",
     *                 "rating": 5,
     *                 "review_title": "Good movie but pacing was a bit slow.",
     *                 "review_content": "Architecto blanditiis et quidem ut. Ut nostrum qui necessitatibus ut. Nemo deleniti commodi eum."
     *             }
     *         ],
     *         "rating_breakdown": [
     *             {
     *                 "stars": 5,
     *                 "count": 15
     *             },
     *             {
     *                 "stars": 4,
     *                 "count": 10
     *             },
     *             {
     *                 "stars": 3,
     *                 "count": 11
     *             },
     *             {
     *                 "stars": 2,
     *                 "count": 11
     *             },
     *             {
     *                 "stars": 1,
     *                 "count": 0
     *             }
     *         ]
     *     }
     * }
     */
    public function movieDetails(Request $request, Movie $movie)
    {
        $movie->load('movieRatings');

        return $this->responseSuccess('OK', new MovieResource($movie));
    }
}
