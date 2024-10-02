<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class OpeningSchedule
{
    public function __construct(
        public OpeningTime $weekday,
        public OpeningTime $saturday,
        public OpeningTime $sunday,
    ) {
    }

    public static function fromArray(array $officeData): self
    {
        Assert::stringNotEmpty($officeData['workingTimeFrom']);
        Assert::stringNotEmpty($officeData['workingTimeTo']);
        Assert::stringNotEmpty($officeData['workingTimeHalfFrom']);
        Assert::stringNotEmpty($officeData['workingTimeHalfTo']);
        Assert::stringNotEmpty($officeData['workingTimeDayOffFrom']);
        Assert::stringNotEmpty($officeData['workingTimeDayOffTo']);

        return new self(
            new OpeningTime($officeData['workingTimeFrom'], $officeData['workingTimeTo']),
            new OpeningTime($officeData['workingTimeHalfFrom'], $officeData['workingTimeHalfTo']),
            new OpeningTime($officeData['workingTimeDayOffFrom'], $officeData['workingTimeDayOffTo'])
        );
    }
}
