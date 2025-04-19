<?php

namespace App\Enum;

enum Diet: int
{
    case Meat = 0;
    case Vegetarian = 1;
    case Vegan = 2;

    public function label(): string
    {
        return match ($this) {
            self::Meat => 'Mięsożerna',
            self::Vegetarian => 'Wegetariańska',
            self::Vegan => 'Wegańska',
        };
    }
}
