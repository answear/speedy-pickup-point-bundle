<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

class OpeningTime
{
    public string $from;
    public string $to;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function isClosed(): bool
    {
        return '00:00' === $this->from && '00:00' === $this->to;
    }
}
