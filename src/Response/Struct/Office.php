<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Answear\SpeedyBundle\Enum\CargoType;
use Answear\SpeedyBundle\Enum\OfficeType;
use Webmozart\Assert\Assert;

class Office
{
    private const ID = 'id';
    private const NAME = 'name';
    private const NAME_EN = 'nameEn';
    private const SITE_ID = 'siteId';
    private const ADDRESS = 'address';

    public int $id;
    public string $name;
    public string $nameEn;
    public int $siteId;
    public OfficeAddress $address;
    public WorkingTime $workingTime;
    public ShipmentParcelSize $maxParcelDimension;
    public float $maxParcelWeight;
    public OfficeType $type;
    public ?int $nearbyOfficeId;
    public bool $palletOffice;
    public bool $cardPaymentAllowed;
    public bool $cashPaymentAllowed;
    public \DateTimeInterface $validFrom;
    public \DateTimeInterface $validTo;
    /** @var CargoType[] */
    public array $cargoTypesAllowed;
    public bool $pickUpAllowed;
    public bool $dropOffAllowed;

    public static function fromArray(array $officeData): self
    {
        Assert::integer($officeData[static::ID]);
        Assert::stringNotEmpty($officeData[static::NAME]);
        Assert::stringNotEmpty($officeData[static::NAME_EN]);
        Assert::integer($officeData[static::SITE_ID]);
        Assert::isArray($officeData[static::ADDRESS]);
        Assert::isArray($officeData['workingTime']);
        Assert::isArray($officeData['maxParcelDimensions']);
        Assert::float($officeData['maxParcelWeight']);
        Assert::string($officeData['type']);
        Assert::boolean($officeData['palletOffice']);
        Assert::boolean($officeData['cardPaymentAllowed']);
        Assert::boolean($officeData['cashPaymentAllowed']);
        Assert::stringNotEmpty($officeData['validFrom']);
        Assert::stringNotEmpty($officeData['validTo']);
        Assert::isArray($officeData['cargoTypesAllowed']);
        Assert::boolean($officeData['pickUpAllowed']);
        Assert::boolean($officeData['dropOffAllowed']);

        $office = new self();
        $office->id = $officeData[static::ID];
        $office->name = $officeData[static::NAME];
        $office->nameEn = $officeData[static::NAME_EN];
        $office->siteId = $officeData[static::SITE_ID];
        $office->address = OfficeAddress::fromArray($officeData[static::ADDRESS]);
        $office->workingTime = WorkingTime::fromArray($officeData['workingTime']);
        $office->maxParcelDimension = ShipmentParcelSize::fromArray($officeData['maxParcelDimensions']);
        $office->maxParcelWeight = $officeData['maxParcelWeight'];
        $office->type = OfficeType::get($officeData['type']);
        $office->nearbyOfficeId = $officeData['nearbyOfficeId'] ?? null;
        $office->palletOffice = $officeData['palletOffice'];
        $office->cardPaymentAllowed = $officeData['cardPaymentAllowed'];
        $office->cashPaymentAllowed = $officeData['cashPaymentAllowed'];
        $office->validFrom = new \DateTimeImmutable($officeData['validFrom']);
        $office->validTo = new \DateTimeImmutable($officeData['validTo']);
        $office->pickUpAllowed = $officeData['pickUpAllowed'];
        $office->dropOffAllowed = $officeData['dropOffAllowed'];
        $office->cargoTypesAllowed = array_map(fn ($type) => CargoType::get($type), $officeData['cargoTypesAllowed']);

        return $office;
    }
}
