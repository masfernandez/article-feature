<?php

declare(strict_types=1);

namespace Masfernandez\ArticleFeature\Tests\Shared;

use Faker\Factory;
use Faker\Generator;

class FakerMother
{
    private static ?Generator $faker;

    public static function random(): Generator
    {
        return self::$faker = self::$faker ?? Factory::create();
    }
}
