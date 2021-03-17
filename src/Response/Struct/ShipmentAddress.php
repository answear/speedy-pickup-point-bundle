<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Webmozart\Assert\Assert;

class ShipmentAddress
{
    public int $countryId;
    public int $siteId;
    public string $siteType;
    public string $siteName;
    public string $postCode;
    public ?int $streetId;
    public ?string $streetType;
    public ?string $streetName;
    public ?string $streetNo;
    public float $latitude;
    public float $longitude;
    public ?string $addressNote;

    public static function fromArray(array $addressData): self
    {
        $address = new self();
        $address->setBaseShipmentProperties($addressData);

        return $address;
    }

    protected function setBaseShipmentProperties(array $addressData): void
    {
        Assert::keyExists($addressData, 'countryId');
        Assert::keyExists($addressData, 'siteId');
        Assert::keyExists($addressData, 'siteType');
        Assert::keyExists($addressData, 'siteName');
        Assert::keyExists($addressData, 'postCode');
        Assert::keyExists($addressData, 'x');
        Assert::keyExists($addressData, 'y');

        $this->countryId = $addressData['countryId'];
        $this->siteId = $addressData['siteId'];
        $this->siteType = $addressData['siteType'];
        $this->siteName = $addressData['siteName'];
        $this->postCode = $addressData['postCode'];
        $this->streetId = $addressData['streetId'] ?? null;
        $this->streetType = $addressData['streetType'] ?? null;
        $this->streetName = $addressData['streetName'] ?? null;
        $this->streetType = $addressData['streetType'] ?? null;
        $this->streetNo = $addressData['streetNo'] ?? null;
        $this->latitude = $addressData['y'];
        $this->longitude = $addressData['x'];
        $this->addressNote = $addressData['addressNote'] ?? null;
    }
}
