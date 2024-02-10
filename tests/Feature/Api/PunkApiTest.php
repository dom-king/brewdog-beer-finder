<?php
namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PunkApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @return void
     */
    public function testAuthenticatedUserCanAccessUserEndpoint(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user, 'api')
            ->getJson('/api/user');

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/user');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testAuthenticatedUserRequestsToPunkApi(): void
    {
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/beers');

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testUnauthorizedUserCannotAccessUserEndpoint(): void
    {
        $response = $this->getJson('/api/user');

        $response->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function testUnauthorizedUserRequestsToPunkApi(): void
    {
        // Make a request to the Punk API without authentication
        $response = $this->getJson('/api/beers');

        // Ensure the response status is 401 Unauthorized
        $response->assertUnauthorized();
    }

    /**
     * @return void
     */
    public function testAuthenticatedUserRequestsWithExpectedResponse(): void
    {
        $user = User::factory()->create();

        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/beers');

        $response->assertStatus(200);

        $responseData = $response->json();


        if (isset($responseData['beers']) && is_array($responseData['beers'])) {
            foreach ($responseData['beers'] as $beer) {
                $this->assertArrayHasKey('id', $beer, 'Beer item does not contain the key "id"');
                $this->assertArrayHasKey('name', $beer, 'Beer item does not contain the key "name"');
            }
        } else {
            $this->fail('Response does not contain "beers" key or "beers" key is not an array');
        }
    }
}
