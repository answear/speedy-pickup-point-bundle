<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

readonly class PostCode
{
    public function __construct(
        public string $postCode,
        public int $siteId,
    ) {
    }
}
