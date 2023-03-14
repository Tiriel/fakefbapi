<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class Biased extends Base
{
    public static function biasLowerNumberBetween(int $min, int $max, string $function)
    {
        do {
            $x = mt_rand() / mt_getrandmax();
            $y = mt_rand() / (mt_getrandmax() + 1);
        } while (call_user_func($function, $x) > $y);

        return (int) floor($x * ($max - $min + 1) + $min);
    }
}
