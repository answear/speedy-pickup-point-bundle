<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class OfficeAddress extends ShipmentAddress
{
    private const SITE_ADDRESS_STRING = 'siteAddressString';
    private const FULL_ADDRESS_STRING = 'fullAddressString';
    private const LOCAL_ADDRESS_STRING = 'localAddressString';

    public string $fullAddressString;
    public string $siteAddressString;
    public string $localAddressString;

    public static function fromArray(array $addressData): self
    {
        Assert::keyExists($addressData, self::FULL_ADDRESS_STRING);
        Assert::keyExists($addressData, self::SITE_ADDRESS_STRING);
        Assert::keyExists($addressData, self::LOCAL_ADDRESS_STRING);

        $address = new self();
        $address->setBaseShipmentProperties($addressData);
        $address->fullAddressString = $addressData[self::FULL_ADDRESS_STRING];
        $address->siteAddressString = $addressData[self::SITE_ADDRESS_STRING];
        $address->localAddressString = $addressData[self::LOCAL_ADDRESS_STRING];

        return $address;
    }
}
