<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class ShipmentParcelSize
{
    public int $width;
    public int $height;
    public int $depth;

    public static function fromArray(array $data): self
    {
        Assert::keyExists($data, 'width');
        Assert::keyExists($data, 'height');
        Assert::keyExists($data, 'depth');

        $size = new self();
        $size->width = $data['width'];
        $size->height = $data['height'];
        $size->depth = $data['depth'];

        return $size;
    }
}
