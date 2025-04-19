<?php

namespace App\Enum;

enum Gender: int
{
    case Male = 0;
    case Female = 1;

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Mężczyzna',
            self::Female => 'Kobieta',
        };
    }
}
