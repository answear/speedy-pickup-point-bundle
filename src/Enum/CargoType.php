<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Enum;

use MabeEnum\Enum;

class CargoType extends Enum
{
    public const PARCEL = 'PARCEL';
    public const PALLET = 'PALLET';
    public const TYRE = 'TYRE';

    public static function parcel(): self
    {
        return static::get(static::PARCEL);
    }

    public static function pallet(): self
    {
        return static::get(static::PALLET);
    }

    public static function tyre(): self
    {
        return static::get(static::PALLET);
    }
}
