<?php
declare(strict_types=1);

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery
{
    protected array $filterable = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    protected array $columns = [
        'postalCode' => 'postal_code',
    ];

    protected array $operators = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function transform(Request $request): array
    {
        $queryItems = [];

        foreach ($this->filterable as $parameter => $operators) {
            $query = $request->query($parameter);

            if (isset($query)) {
                $column = $this->columns[$parameter] ?? $parameter;

                foreach ($operators as $operator) {
                    if (isset($query[$operator])) {
                        $queryItems[] = [$column, $this->operators[$operator], $query[$operator]];
                    }
                }
            }
        }

        return $queryItems;
    }
}
