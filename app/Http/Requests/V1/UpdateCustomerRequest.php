<?php

namespace App\Http\Requests\V1;

use App\Enums\CustomerType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('PUT')) {
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

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'integer', Rule::in(CustomerType::values())],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:customers'],
            'address' => ['sometimes', 'required', 'string', 'max:255'],
            'city' => ['sometimes', 'required', 'string', 'max:255'],
            'state' => ['sometimes', 'required', 'string', 'max:255'],
            'postalCode' => ['sometimes', 'required', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->postalCode !== null) {
            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
