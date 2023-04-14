<?php
declare(strict_types=1);

namespace App\Filters\V1;

use App\Filters\Filter;

class InvoiceFilter extends Filter
{
    protected array $filterable = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'neq'],
        'billedAt' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'paidAt' => ['eq'],
    ];

    protected array $columns = [
        'customerId' => 'customer_id',
        'billedAt' => 'billed_at',
        'paidAt' => 'paid_at',
    ];

    protected array $operators = [
        'eq' => '=',
        'neq' => '!=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
}
