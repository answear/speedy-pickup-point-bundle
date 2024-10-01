<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

readonly class WorkingTime
{
    public \DateTimeInterface $date;

    public function __construct(
        string $date,
        public string $timeFrom,
        public string $timeTo,
        public bool $standardSchedule,
    ) {
        $this->date = new \DateTimeImmutable($date);
    }
}
