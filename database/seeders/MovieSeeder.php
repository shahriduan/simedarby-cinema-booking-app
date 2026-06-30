<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Supergirl',
                'release_date' => '2026-06-04',
                'classification' => '13',
                'duration_minutes' => 108,
                'genre' => ['Action'],
                'synopsis' => 'It follows Kara Zor-El\'s story and her darker origin before she finally made her way to Earth.',
                'casts' => 'Milly Alcock, Eve Ridley, Matthias Schoenaerts, Jason Momoa, David Krumholtz',
                'director' => 'Craig Gillespie',
                'writers' => 'Ana Nogueira, Jerry Siegel, Joe Shuster',
                'poster_url' => '/img/movies/supergirl.jpg',
                'trailer_url' => 'https://youtu.be/rIRlkL1U3zY?si=jXo0IDc1vWmsS1wg'
            ],
            [
                'title' => 'Toy Story 5',
                'release_date' => '2026-06-17',
                'classification' => 'P12',
                'duration_minutes' => 102,
                'genre' => ['Animation'],
                'synopsis' => 'Woody, Buzz, Jessie, and the rest of the gang\'s jobs get exponentially harder when they go head to head with an all new threat to playtime: technology.',
                'casts' => 'Tim Allen, Blake Clark,Tom Hanks, Joan Cusack, Greta Lee',
                'director' => 'McKenna Harris, Andrew Stanton',
                'writers' => 'Andrew Stanton, McKenna Harris',
                'poster_url' => '/img/movies/toy-story-5.jpg',
                'trailer_url' => 'https://youtu.be/NFJk9JtHCTw?si=yw2knq3V-g48SSdR'
            ],
            [
                'title' => 'The Death Of Robin Hood',
                'release_date' => '2026-06-18',
                'classification' => '16',
                'duration_minutes' => 122,
                'genre' => ['Action'],
                'synopsis' => 'Grappling with his past after a life of crime and murder, Robin Hood finds himself gravely injured after a battle he thought would be his last. In the hands of a mysterious woman, he is offered a chance at salvation.',
                'casts' => 'Hugh Jackman, Jodie Comer, Bill Skarsgård, Murray Bartlett, Noah Jupe, Faith Delaney',
                'director' => 'Michael Sarnoski',
                'writers' => 'Michael Sarnoski',
                'poster_url' => '/img/movies/the-death-of-robin-hood.jpg',
                'trailer_url' => 'https://youtu.be/goLcYMt7pfg?si=M9HZHLWNijcHvbOz'
            ],
            [
                'title' => 'Masters Of The Universe',
                'release_date' => '2026-06-04',
                'classification' => '13',
                'duration_minutes' => 141,
                'genre' => ['Action'],
                'synopsis' => 'A young man on Earth discovers a fabulous secret legacy as the prince of an alien planet, and must recover a magic sword and return home to protect his kingdom.',
                'casts' => 'Nicholas Galitzine, Morena Baccarin, Idris Elba, James Purefoy, Jared Leto',
                'director' => 'Travis Knight',
                'writers' => 'Chris Butler, Aaron Nee, Adam Nee',
                'poster_url' => '/img/movies/masters-of-the-universe.jpg',
                'trailer_url' => 'https://youtu.be/Vf_5H3T8Y7Q?si=HOg0l0F5EeMOpMvG'
            ]
        ];

        $cinemaIds = Cinema::pluck('id');
        
        foreach ($movies as $movie) {
            $newMovie = Movie::firstOrCreate([
                'title' => $movie['title'],
            ], [
                'release_date' => $movie['release_date'],
                'classification' => $movie['classification'],
                'duration_minutes' => $movie['duration_minutes'],
                'genre' => $movie['genre'],
                'synopsis' => $movie['synopsis'],
                'casts' => $movie['casts'],
                'director' => $movie['director'],
                'writers' => $movie['writers'],
                'poster_url' => $movie['poster_url'],
                'trailer_url' => $movie['trailer_url'],
            ]);

            $newMovie->cinemas()->syncWithoutDetaching($cinemaIds->toArray());
        }
    }
}
