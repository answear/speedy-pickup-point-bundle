<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class PostCodeCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var PostCode[]
     */
    private array $postCodes;

    public function __construct(array $postCodes)
    {
        Assert::allIsInstanceOf($postCodes, PostCode::class);

        $this->postCodes = $postCodes;
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
