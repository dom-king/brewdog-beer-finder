<?php

namespace App\Http\Controllers;

use App\Services\PunkApiService;

class PunkApiController extends Controller
{
    protected $punkApiService;

    /**
     * Create a new controller instance.
     *
     * @param PunkApiService $punkApiService
     */
    public function __construct(PunkApiService $punkApiService)
    {
        $this->punkApiService = $punkApiService;
    }

    /**
     * Get all beers
     *
     * @return array
     */
    public function index(): array
    {
        return $this->punkApiService->getBeers();
    }

    /**
     * Get a beer by id
     *
     * @param int $id
     * @return array
     */
    public function show($id): array
    {
        return $this->punkApiService->getBeerById($id);
    }
}
