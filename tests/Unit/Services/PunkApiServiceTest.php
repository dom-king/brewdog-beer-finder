<?php

use App\Services\PunkApiService;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use function Pest\Laravel\get;
use Tests\TestCase;

test('it can get all beers', function () {
    // Set up an instance of the service
    $punkApiService = new PunkApiService();

    // Mock the HTTP response for the base URL + 'beers' endpoint
    Http::fake([
        $punkApiService->getBaseUrl() . 'beers' => Http::response([/* Mocked beer data */], 200),
    ]);

    // Call the getBeers method
    $beers = $punkApiService->getBeers();

    // Assertions
    Http::assertSent(function ($request) use ($punkApiService) {
        return $request->url() === $punkApiService->getBaseUrl() . 'beers';
    });

    expect($beers)->toBeInstanceOf(AnonymousResourceCollection::class);
});

test('it can search for beers', function () {
    // Set up an instance of the service
    $punkApiService = new PunkApiService();

    // Mock the HTTP response for the base URL + 'beers' endpoint with search parameters
    Http::fake([
        $punkApiService->getBaseUrl() . 'beers/' => Http::response([/* Mocked beer data */], 200),
    ]);

    // Call the searchBeers method
    $searchResults = $punkApiService->searchBeers('filter', 'searchTerm');

    // Assertions
    Http::assertSent(function ($request) use ($punkApiService) {
        // Add more specific assertions based on your actual implementation
        return $request->url() === $punkApiService->getBaseUrl() . 'beers/' &&
            $request->query() === ['beer_filter' => 'filter', 'beer_searchTerm' => 'searchTerm'];
    });

    expect($searchResults)->toBeArray();
});
