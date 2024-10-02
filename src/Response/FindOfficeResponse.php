<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Answear\SpeedyBundle\Response\Struct\Office;
use Answear\SpeedyBundle\Response\Struct\OfficeCollection;
use Webmozart\Assert\Assert;

readonly class FindOfficeResponse
{
    public function __construct(public OfficeCollection $offices)
    {
    }

    public static function fromArray(array $arrayResponse): self
    {
        Assert::keyExists($arrayResponse, 'offices');

        return new self(
            new OfficeCollection(
                array_map(
                    static fn ($officeData) => Office::fromArray($officeData),
                    $arrayResponse['offices']
                )
            )
        );
    }
}
