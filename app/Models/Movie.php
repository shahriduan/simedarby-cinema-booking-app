<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'release_date',
        'classification',
        'duration_minutes',
        'genre',
        'synopsis',
        'casts',
        'director',
        'writers',
        'poster_url',
        'trailer_url'
    ];

    protected $casts = [
        'release_date' => 'date',
        'genre' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function cinemas()
    {
        return $this->belongsToMany(Cinema::class);
    }

    public function movieRatings()
    {
        return $this->hasMany(MovieRating::class)->orderBy('rating', 'desc');
    }
}
