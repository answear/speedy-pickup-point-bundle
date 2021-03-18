<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class WorkingTimeSchedule implements \Countable, \IteratorAggregate
{
    /**
     * @var WorkingTime[]
     */
    private array $workingTimeCollection;

    public static function fromArray(array $data): self
    {
        Assert::keyExists($data, 'workingTimeSchedule');
        Assert::allKeyExists($data['workingTimeSchedule'], 'date');
        Assert::allKeyExists($data['workingTimeSchedule'], 'workingTimeFrom');
        Assert::allKeyExists($data['workingTimeSchedule'], 'workingTimeTo');
        Assert::allKeyExists($data['workingTimeSchedule'], 'standardSchedule');

        $schedule = new self();
        foreach ($data['workingTimeSchedule'] as $workingTime) {
            $schedule->workingTimeCollection[] = new WorkingTime(
                $workingTime['date'],
                $workingTime['workingTimeFrom'],
                $workingTime['workingTimeTo'],
                $workingTime['standardSchedule']
            );
        }

        return $schedule;
    }

    /**
     * @return WorkingTime[]
     */
    public function getIterator(): iterable
    {
        foreach ($this->workingTimeCollection as $key => $workingTime) {
            yield $key => $workingTime;
        }
    }

    public function count(): int
    {
        return \count($this->workingTimeCollection);
    }
}
