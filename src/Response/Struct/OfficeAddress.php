<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class OfficeAddress extends ShipmentAddress
{
    public string $fullAddressString;
    public string $siteAddressString;
    public string $localAddressString;

    public static function fromArray(array $addressData): self
    {
        Assert::keyExists($addressData, 'siteAddressString');
        Assert::keyExists($addressData, 'fullAddressString');
        Assert::keyExists($addressData, 'localAddressString');

        $address = new self();
        $address->setBaseShipmentProperties($addressData);
        $address->fullAddressString = $addressData['fullAddressString'];
        $address->siteAddressString = $addressData['siteAddressString'];
        $address->localAddressString = $addressData['localAddressString'];

        return $address;
    }
}
