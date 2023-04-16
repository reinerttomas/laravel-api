<?php

namespace App\Http\Requests\V1;

use App\Enums\InvoiceStatus;
use App\Http\Requests\Timestampable;
use App\Http\Requests\Transformable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBulkInvoiceRequest extends FormRequest
{
    use Transformable, Timestampable;

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
        return [
            '*.customerId' => ['required', 'integer', 'exists:customers,id'],
            '*.amount' => ['required', 'numeric', 'min:0'],
            '*.status' => ['required', 'string', Rule::in(InvoiceStatus::values())],
            '*.billedAt' => ['required', 'date_format:Y-m-d H:i:s'],
            '*.paidAt' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->transform();
        $this->timestamps();
    }
}
