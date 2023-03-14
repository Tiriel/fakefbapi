<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class EnumProvider extends Base
{
    public static function randomEnumCase(string|\UnitEnum|\BackedEnum $enumName, bool $biased = false): \BackedEnum
    {
        if (!enum_exists($enumName)) {
            throw new \RuntimeException(sprintf("The %s enumeration does not exist or is not registered.", $enumName));
        }
        $cases = $enumName::cases();

        return $cases[Biased::biasLowerNumberBetween(0, (\count($cases) -1), 'log')];
    }
}
