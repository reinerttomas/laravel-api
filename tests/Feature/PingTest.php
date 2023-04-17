<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PingTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_ping(): void
    {
        $response = $this->json('get', 'api/v1/ping');

        $response->assertUnauthorized();
    }

    public function test_user_can_ping(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->json('get', 'api/v1/ping');

        $response->assertOk();
        $response->assertJson([
            'message' => 'pong',
        ]);
    }
}
