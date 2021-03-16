<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Answear\SpeedyBundle\Response\Struct\Office;
use Answear\SpeedyBundle\Response\Struct\OfficeCollection;
use Webmozart\Assert\Assert;

class FindOfficeResponse
{
    private const OFFICES = 'offices';

    public OfficeCollection $offices;

    public function __construct(OfficeCollection $offices)
    {
        $this->offices = $offices;
    }

    public function getOffices(): OfficeCollection
    {
        return $this->offices;
    }

    public static function fromArray(array $arrayResponse): self
    {
        Assert::keyExists($arrayResponse, static::OFFICES);

        $offices = [];
        foreach ($arrayResponse[static::OFFICES] as $officeData) {
            $office = Office::fromArray($officeData);

            $offices[] = $office;
        }

        return new self(new OfficeCollection($offices));
    }
}
