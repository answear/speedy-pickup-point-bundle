<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Enum;

enum CargoType: string
{
    case Parcel = 'PARCEL';
    case Pallet = 'PALLET';
    case Tyre = 'TYRE';
}
