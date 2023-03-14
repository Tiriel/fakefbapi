<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;
use Faker\Provider\Lorem;

class LinkNameProvider extends Base
{
    public static function linkName(?string $url): ?string
    {
        return $url ? Lorem::sentence() : null;
    }
}
