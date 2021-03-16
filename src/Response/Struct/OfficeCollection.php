<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

/**
 * Only Address type 1 supported
 *
 * @url https://api.speedy.bg/web-api.html#href-ds-shipment-address
 */
class OfficeCollection implements \Countable
{
    /**
     * @var Office[]
     */
    private array $offices;

    public function __construct(array $offices)
    {
        Assert::allIsInstanceOf($offices, Office::class);

        $this->offices = $offices;
    }

    /**
     * @return Office[]
     */
    public function toArray(): array
    {
        return $this->offices;
    }

    public function count(): int
    {
        return \count($this->offices);
    }
}
