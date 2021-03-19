<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

class WorkingTime
{
    public \DateTimeInterface $date;
    public string $timeFrom;
    public string $timeTo;
    public bool $standardSchedule;

    public function __construct(string $date, string $timeFrom, string $timeTo, bool $standardSchedule)
    {
        $this->date = new \DateTimeImmutable($date);
        $this->timeFrom = $timeFrom;
        $this->timeTo = $timeTo;
        $this->standardSchedule = $standardSchedule;
    }
}
