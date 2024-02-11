<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\BeerController;
use App\Http\Resources\BeerResource;
use App\Services\PunkApiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Mockery;
use Tests\TestCase;

class BeerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected PunkApiService $mockedPunkApiService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->mockedPunkApiService = Mockery::mock(PunkApiService::class);
        $this->app->instance(PunkApiService::class, $this->mockedPunkApiService);
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @return void
     */
    public function testBeerIndexReturnsJsonResponse(): void
    {
        $this->mockedPunkApiService
            ->shouldReceive('getBeers')
            ->once()
            ->andReturn(AnonymousResourceCollection::make([], BeerResource::class));

        $controller = new BeerController($this->mockedPunkApiService);
        $response = $controller->index();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testBeerSearchReturnsJsonResponse(): void
    {
        $request = Mockery::mock(\Illuminate\Http\Request::class);

        $request
            ->shouldReceive('input')
            ->with('filter')
            ->andReturn('ID');

        $request
            ->shouldReceive('input')
            ->with('search')
            ->andReturn('1');

        $this->mockedPunkApiService
            ->shouldReceive('searchBeers')
            ->with('ID', '1')
            ->once()
            ->andReturn([]);

        $controller = new BeerController($this->mockedPunkApiService);

        $response = $controller->search($request, $this->mockedPunkApiService);

        $this->assertInstanceOf(JsonResponse::class, $response);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testBeerSearchHandlesInvalidFilter(): void
    {
        $request = new Request(['filter' => 'invalid_filter', 'search' => 'term']);

        $controller = new BeerController($this->mockedPunkApiService);
        $response = $controller->search($request, $this->mockedPunkApiService);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(422, $response->getStatusCode());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testBeerSearchHandlesException(): void
    {
        // Mock the request and service
        $request = Mockery::mock(\Illuminate\Http\Request::class);

        $request
            ->shouldReceive('input')
            ->with('filter')
            ->andReturn('ID');

        $request
            ->shouldReceive('input')
            ->with('search')
            ->andReturn('1');

        $this->mockedPunkApiService
            ->shouldReceive('searchBeers')
            ->with('ID', '1')
            ->once()
            ->andThrow(new \Exception('Error searching for beers.'));

        $controller = new BeerController($this->mockedPunkApiService);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Error searching for beers.');

        $controller->search($request, $this->mockedPunkApiService);
    }
}
