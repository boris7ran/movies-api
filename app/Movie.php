<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    const STORE_RULES = [
        'title' => 'required',
        'duration' => 'required | integer | between:1,500',
        'director' => 'required',
        'releaseDate' => 'required',
        'imageUrl' => 'url'
    ];
}