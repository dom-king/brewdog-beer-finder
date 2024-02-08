<?php
namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PunkApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array
     */
    public function invalidBeerIdProvider(): array
    {
        return [
            [0],
            [-1],
            [null],
            [''],
            ['abc'],
        ];
    }

    /**
     * @return void
     */
    public function testAuthenticatedUserRequestsToPunkApi() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/user');

        $response->assertStatus(200);

        $response = $this->actingAs($user)
            ->getJson('/api/beers');

        $response->assertStatus(200);

        $response = $this->actingAs($user)
            ->getJson('/api/beers/1');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testUnauthorizedUserRequestsToPunkApi() : void
    {
        $response = $this->getJson('/api/user');
        $response->assertUnauthorized();

        $response = $this->getJson('/api/beers');
        $response->assertUnauthorized();

        $response = $this->getJson('/api/beers/{id}');
        $response->assertUnauthorized();
    }

    /**
     * @dataProvider invalidBeerIdProvider
     */
    public function testAuthenticatedUserRequestsToPunkApiWithInvalidId() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/beers/123abc');

        $response->assertStatus(200)
        ->assertJson([
            'statusCode' => 400,
            'error' => 'Bad Request',
            'message' => 'Invalid query params',
            'data' => [
                [
                    'location' => 'params',
                    'param' => 'beerId',
                    'msg' => 'beerId must be a number and greater than 0',
                    'value' => '123abc',
                ]
            ],
        ]);
    }

    /**
     * @return void
     */
    public function testAuthenticatedUserRequestsWithExpectedResponse() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson('/api/beers/1');

        $response->assertStatus(200)
            ->assertJson(json_decode(file_get_contents(base_path('tests/Feature/Stubs/expected_api_response.json')), true));
    }
}
