<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class OfficeAddress extends ShipmentAddress
{
    public string $fullAddressString;
    public string $siteAddressString;
    public string $localAddressString;

    public static function fromArray(array $officeData): self
    {
        Assert::keyExists($officeData, 'fullAddressString');
        Assert::keyExists($officeData, 'siteAddressString');
        Assert::keyExists($officeData, 'localAddressString');

        return new self();
    }

    public function getFullAddressString(): string
    {
        return $this->fullAddressString;
    }

    public function getSiteAddressString(): string
    {
        return $this->siteAddressString;
    }

    public function getLocalAddressString(): string
    {
        return $this->localAddressString;
    }
}
