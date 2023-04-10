<?php
declare(strict_types=1);

namespace App\Enums;

enum CustomerType: int
{
    case INDIVIDUAL = 1;
    case BUSINESS = 2;
}
