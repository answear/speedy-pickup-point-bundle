<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

/**
 * Only Address type 1 supported
 *
 * @url https://api.speedy.bg/web-api.html#href-ds-shipment-address
 */
readonly class OfficeCollection implements \Countable, \IteratorAggregate
{
    /**
     * @param Office[] $offices
     */
    public function __construct(private array $offices)
    {
        Assert::allIsInstanceOf($offices, Office::class);
    }

    /**
     * @return \Traversable<Office>
     */
    public function getIterator(): \Traversable
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
