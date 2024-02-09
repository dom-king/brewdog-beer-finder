<?php

namespace App\Services;

use App\Http\Resources\BeerResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;

class PunkApiService
{
    protected mixed $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('punkapi.base_url');
    }

    /**
     * Get the base URL.
     *
     * @return mixed
     */
    public function getBaseUrl(): mixed
    {
        return $this->baseUrl;
    }

    /**
     * Get all beers
     *
     * @return AnonymousResourceCollection
     */
    public function getBeers(): AnonymousResourceCollection
    {
        $response = Http::get($this->baseUrl . 'beers');
        $beers = $response->json();

        return BeerResource::collection($beers);
    }

    /**
     * Search for beers based on a filter and search term
     *
     * @param string $filter
     * @param string $searchTerm
     * @return array
     */
    public function searchBeers(string $filter, string $searchTerm): array
    {
        $response = Http::get($this->baseUrl . 'beers/', [
            'beer_' . $filter => $searchTerm,
        ]);

        $data = $response->json();

        return $data;
    }
}
