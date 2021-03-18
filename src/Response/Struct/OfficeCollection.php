<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

/**
 * Only Address type 1 supported
 *
 * @url https://api.speedy.bg/web-api.html#href-ds-shipment-address
 */
class OfficeCollection implements \Countable, \IteratorAggregate
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
    public function getIterator(): iterable
    {
        foreach ($this->offices as $key => $office) {
            yield $key => $office;
        }
    }

    public function get($key): ?Office
    {
        return $this->offices[$key] ?? null;
    }

    public function count(): int
    {
        return \count($this->offices);
    }
}
