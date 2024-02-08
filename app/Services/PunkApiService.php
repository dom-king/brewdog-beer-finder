<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PunkApiService
{
    protected mixed $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('punkapi.base_url');
    }

    /**
     * Get all beers
     *
     * @return array
     */
    public function getBeers(): array
    {
        $response = Http::get($this->baseUrl . 'beers');
        return $response->json();
    }

    /**
     * Get a beer by id
     *
     * @param int $id
     * @return array
     */
    public function getBeerById($id): array
    {
        $response = Http::get($this->baseUrl . "beers/{$id}");
        return $response->json();
    }
}
