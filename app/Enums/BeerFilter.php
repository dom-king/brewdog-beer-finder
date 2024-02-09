<?php

namespace App\Enums;

enum BeerFilter: string
{
    case ID = 'ID';
    case NAME = 'Name';

    public static function values(): array
    {
        return [
            self::ID->value,
            self::NAME->value,
        ];
    }
}

