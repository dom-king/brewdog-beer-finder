<?php

namespace App\Services;

use App\Http\Resources\BeerResource;
use App\Models\Beer;
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
        $beers = Beer::all();
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
