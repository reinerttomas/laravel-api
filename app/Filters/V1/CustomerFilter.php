<?php
declare(strict_types=1);

namespace App\Filters\V1;

use App\Filters\Filter;

class CustomerFilter extends Filter
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
}
