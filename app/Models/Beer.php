<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tagline',
        'first_brewed',
        'description',
        'abv',
        'ibu',
        'image_url',
    ];

    protected $casts = [
        'food_pairing' => 'json',
    ];
}
