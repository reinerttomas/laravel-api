<?php
declare(strict_types=1);

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filter
{
    protected array $filterable = [];
    protected array $columns = [];
    protected array $operators = [];

    public function transform(Request $request): array
    {
        $queries = [];

        foreach ($this->filterable as $parameter => $operators) {
            $query = $request->query($parameter);

            if (isset($query)) {
                $column = $this->columns[$parameter] ?? $parameter;

                foreach ($operators as $operator) {
                    if (isset($query[$operator])) {
                        $queries[] = [$column, $this->operators[$operator], $query[$operator]];
                    }
                }
            }
        }

        return $queries;
    }
}
