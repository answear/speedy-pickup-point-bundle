<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class SiteCollection implements \Countable, \IteratorAggregate
{
    /**
     * @param Site[] $sites
     */
    public function __construct(public array $sites)
    {
        Assert::allIsInstanceOf($sites, Site::class);
    }

    /**
     * @return \Traversable<Site>
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->sites as $key => $site) {
            yield $key => $site;
        }
    }

    public function get($key): ?Site
    {
        return $this->sites[$key] ?? null;
    }

    public function count(): int
    {
        return \count($this->sites);
    }
}
