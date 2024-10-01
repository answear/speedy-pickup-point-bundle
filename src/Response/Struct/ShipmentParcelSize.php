<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

readonly class ShipmentParcelSize
{
    public function __construct(
        public int $width,
        public int $height,
        public int $depth,
    ) {
    }

    public static function fromArray(array $data): self
    {
        Assert::keyExists($data, 'width');
        Assert::keyExists($data, 'height');
        Assert::keyExists($data, 'depth');

        return new self(
            $data['width'],
            $data['height'],
            $data['depth'],
        );
    }
}
