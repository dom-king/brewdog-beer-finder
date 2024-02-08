<?php

use App\Models\Beer;
use Database\Factories\BeerFactory;

it('can create a beer model using the factory', function () : void
{
    $beerFactory = app(BeerFactory::class);

    $beer = $beerFactory->create();

    expect($beer)->toBeInstanceOf(Beer::class)
        ->and($beer->name)->toBeString()
        ->and($beer->tagline)->toBeString()
        ->and($beer->first_brewed)->toBeString()
        ->and($beer->description)->toBeString()
        ->and($beer->abv)->toBeFloat()
        ->and($beer->ibu)->toBeFloat()
        ->and($beer->image_url)->toBeString()
        ->and($beer->food_pairing)->toBeArray();
});

