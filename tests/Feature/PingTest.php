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
        $this->get('api/v1/ping')
            ->assertUnauthorized();
    }

    public function test_user_can_ping(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->get('api/v1/ping')
            ->assertOk()
            ->assertJson([
                'message' => 'pong',
            ]);
    }
}
