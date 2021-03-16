<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Enum;

use MabeEnum\Enum;

class CargoType extends Enum
{
    public const PARCEL = 'parcel';
    public const PALLET = 'pallet';
    public const TYRE = 'tyre';

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
