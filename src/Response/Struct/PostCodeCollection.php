<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class PostCodeCollection implements \Countable, \IteratorAggregate
{
    /**
     * @param PostCode[] $postCodes
     */
    public function __construct(public array $postCodes)
    {
        Assert::allIsInstanceOf($postCodes, PostCode::class);
    }

    /**
     * @return \Traversable<PostCode>
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->postCodes as $key => $postCode) {
            yield $key => $postCode;
        }
    }

    public function get($key): ?PostCode
    {
        return $this->postCodes[$key] ?? null;
    }

    public function count(): int
    {
        return \count($this->postCodes);
    }
}
