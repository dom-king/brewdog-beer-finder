<?php

use App\Models\User;
use App\Services\PunkApiService;
use Inertia\Testing\Assert;
use Tests\TestCase;

it('authenticated user can access PunkApi endpoints', function () {
    $user = User::factory()->create();

    // Test /api/user endpoint
    $response = test()->actingAs($user)->getJson('/api/user');
    $response->assertStatus(200);

    // Test /api/beers endpoint
    $response = test()->actingAs($user)->getJson('/api/beers');
    $response->assertStatus(200);

    // Test /api/beers/1 endpoint
    $response = test()->actingAs($user)->getJson('/api/beers/1');
    $response->assertStatus(200);
});
