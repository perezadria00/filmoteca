<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'surname', 'birthdate', 'country', 'img_url'
    ];

    public $timestamps = true;
}
