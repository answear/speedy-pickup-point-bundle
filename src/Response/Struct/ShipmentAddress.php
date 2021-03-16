<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

class ShipmentAddress
{
    public static function fromArray(array $officeData): self
    {
        return new self();
    }
}
