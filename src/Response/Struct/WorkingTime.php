<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

class WorkingTime
{
    public static function fromArray(array $data): self
    {
        return new self();
    }
}
