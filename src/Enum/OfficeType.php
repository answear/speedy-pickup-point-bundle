<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Enum;

use MabeEnum\Enum;

class OfficeType extends Enum
{
    public const OFFICE = 'OFFICE';
    public const APT = 'APT';

    public static function office(): self
    {
        return static::get(static::OFFICE);
    }

    public static function apt(): self
    {
        return static::get(static::APT);
    }
}
