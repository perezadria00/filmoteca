<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'year', 'genre', 'country', 'duration', 'img_url'
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'films_actors', 'film_id', 'actor_id');
    }
}


