<?php

namespace App\Http\Requests\V1;

use App\Enums\CustomerType;
use App\Http\Bags\V1\StoreCustomerBag;
use App\Http\Requests\Transformable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'integer', Rule::in(CustomerType::values())],
            'email' => ['required', 'email', 'max:255', 'unique:customers'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'postalCode' => ['required', 'string', 'max:255'],
        ];
    }

    public function toBag(): StoreCustomerBag
    {
        return new StoreCustomerBag($this->validated());
    }
}
