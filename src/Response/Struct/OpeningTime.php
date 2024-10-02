<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

readonly class OpeningTime
{
    public function __construct(
        public string $from,
        public string $to,
    ) {
    }

    public function isClosed(): bool
    {
        return '00:00' === $this->from && '00:00' === $this->to;
    }
}
