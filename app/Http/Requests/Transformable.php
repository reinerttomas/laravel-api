<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * @mixin FormRequest
 */
trait Transformable
{
    protected function transform(): void
    {
        $data = collect($this->toArray())->map(function ($array) {
            foreach ($array as $key => $value) {
                $snakeKey = Str::snake($key);

                if ($snakeKey !== $key) {
                    $array[$snakeKey] = $value;
                    unset($array[$key]);
                }
            }

            return $array;
        });

        $this->merge($data->toArray());
    }
}
