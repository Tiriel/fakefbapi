<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;
use Faker\Provider\DateTime;

class ImmutableDateTimeProvider extends Base
{
    public static function immutableDateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null)
    {
        return \DateTimeImmutable::createFromMutable(
            DateTime::dateTimeBetween($startDate, $endDate, $timezone)
        );
    }

    public static function immutableDateTime($max = 'now', $timezone = null)
    {
        return \DateTimeImmutable::createFromMutable(
            DateTime::dateTime($max, $timezone)
        );
    }
}
