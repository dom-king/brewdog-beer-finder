<?php

namespace Tests\Unit\Services;

use App\Models\Beer;
use App\Services\PunkApiService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;

class PunkApiServiceTest extends TestCase
{
    protected PunkApiService $punkApiService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->punkApiService = new PunkApiService();
    }

    /**
     * @return void
     */
    public function testGetBaseUrl(): void
    {
        $baseUrl = $this->punkApiService->getBaseUrl();
        $this->assertEquals(config('punkapi.base_url'), $baseUrl);
    }

    /**
     * @return void
     */
    public function testGetBeersReturnsAnonymousResourceCollection(): void
    {
        $beerModelMock = Mockery::mock(Beer::class);

        $beerModelMock->shouldReceive('all')->andReturn(collect());

        $this->app->instance(Beer::class, $beerModelMock);

        $result = $this->punkApiService->getBeers();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    /**
     * @return void
     */
    public function testSearchBeersReturnsArray(): void
    {
        Http::fake([
            '*' => Http::response([], 200),
        ]);

        $filter = 'ID';
        $searchTerm = '1';

        $result = $this->punkApiService->searchBeers($filter, $searchTerm);

        $this->assertIsArray($result);
    }

    /**
     * @return void
     */
    public function testSearchBeersReturnsEmptyArray(): void
    {
        Http::fake([
            '*' => Http::response([], 200),
        ]);

        $filter = 'ID';
        $searchTerm = '1000';

        $result = $this->punkApiService->searchBeers($filter, $searchTerm);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
