<?php
declare(strict_types=1);

namespace App\Http\Bags\V1;

use App\Enums\CustomerType;
use App\Http\Bags\Bag;

class StoreCustomerBag implements Bag
{
    private string $name;
    private CustomerType $type;
    private string $email;
    private string $address;
    private string $city;
    private string $state;
    private string $postalCode;

    public function __construct(array $attributes)
    {
        $this->name = $attributes['name'];
        $this->type = CustomerType::from($attributes['type']);
        $this->email = $attributes['email'];
        $this->address = $attributes['address'];
        $this->city = $attributes['city'];
        $this->state = $attributes['state'];
        $this->postalCode = $attributes['postalCode'];
    }

    public function attributes(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postalCode,
        ];
    }
}
