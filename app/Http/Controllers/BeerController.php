<?php

namespace App\Http\Controllers;

use App\Enums\BeerFilter;
use App\Services\PunkApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BeerController extends Controller
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
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Beers/Index', [
            'beers' => $this->punkApiService->getBeers(),
        ]);
    }

    /**
     * Get a beer by id
     *
     * @param int $id
     * @return Response
     */
    public function show($id): Response
    {
        return Inertia::render('Beers/Show', [
            'beer' => $this->punkApiService->getBeerById($id),
        ]);
    }

    /**
     * Search for beers based on a filter and search term
     *
     * @param Request $request
     * @param PunkApiService $punkApiService
     * @return JsonResponse
     */
    public function search(Request $request, PunkApiService $punkApiService): JsonResponse
    {
        $filter = $request->input('filter');
        $searchTerm = $request->input('search');

        if (!in_array($filter, BeerFilter::values())) {
            return response()->json(['error' => 'Invalid filter'], 422);
        }

        $beers = $punkApiService->searchBeers($filter, $searchTerm);

        if ($filter === BeerFilter::ID->value && $searchTerm) {
            $beers = $this->filterById($beers, (int)$searchTerm);
        }

        if ($filter === BeerFilter::NAME->value && $searchTerm) {
            $beers = $this->filterByName($beers, (string)$searchTerm);
        }

        return response()->json(['searchResults' => $beers]);
    }

    /**
     * Filter beers by ID
     *
     * @param array $beers
     * @param int $searchTerm
     * @return array
     */
    private function filterById(array $beers, int $searchTerm): array
    {
        $filteredBeer = collect($beers)->firstWhere('id', $searchTerm);
        return $filteredBeer ? [$filteredBeer] : [];
    }

    /**
     * Filter beers by Name
     *
     * @param array $beers
     * @param string $searchTerm
     * @return array
     */
    private function filterByName(array $beers, string $searchTerm): array
    {
        $pattern = '/' . preg_quote($searchTerm, '/') . '/i';
        $filteredBeers = collect($beers)->filter(function ($beer) use ($pattern) {
            return preg_match($pattern, $beer['name']);
        })->values();

        return $filteredBeers->all();
    }

}
