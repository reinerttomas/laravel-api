<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\CustomerType;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class StoreCustomerTest extends TestCase
{
    use WithFaker;

    public function test_guest_cannot_store_customer(): void
    {
        $this->post('api/v1/customers')
            ->assertUnauthorized();
    }

    public function test_user_can_store_customer(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['create']);

        $name = $this->faker->name();
        $type = CustomerType::INDIVIDUAL->value;
        $email = $this->faker->unique()->email();
        $address = $this->faker->streetAddress();
        $city = $this->faker->city();
        $state = $this->faker->state();
        $postalCode = $this->faker->postcode();

        $response = $this->post('api/v1/customers', [
            'name' => $name,
            'type' => $type,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'postalCode' => $postalCode,
        ]);

        $response->assertCreated()
            ->assertJson([
                'name' => $name,
                'type' => $type,
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'state' => $state,
                'postalCode' => $postalCode,
            ]);
    }
}
