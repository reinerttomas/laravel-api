<?php
declare(strict_types=1);

namespace App\Enums;

enum CustomerType: int
{
    case INDIVIDUAL = 1;
    case BUSINESS = 2;

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
