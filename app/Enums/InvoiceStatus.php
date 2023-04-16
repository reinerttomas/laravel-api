<?php
declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: string
{
    case BILLED = 'billed';
    case PAID = 'paid';
    case VOID = 'void';

    public static function values(): array
    {
        $values = [];

        foreach (self::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }
}
