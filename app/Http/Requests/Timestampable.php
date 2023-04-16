<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @mixin FormRequest
 */
trait Timestampable
{
    public function timestamps(): void
    {
        $data = collect($this->toArray())->map(function ($array) {
            $array['created_at'] = now();
            $array['updated_at'] = now();

            return $array;
        });

        $this->merge($data->toArray());
    }
}
