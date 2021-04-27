<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Answear\SpeedyBundle\Enum\CargoType;
use Answear\SpeedyBundle\Enum\OfficeType;
use Webmozart\Assert\Assert;

class Office
{
    public int $id;
    public string $name;
    public string $nameEn;
    public int $siteId;
    public OfficeAddress $address;
    public OpeningSchedule $openingSchedule;
    public WorkingTimeSchedule $workingTimeSchedule;
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
        Assert::integer($officeData['id']);
        Assert::stringNotEmpty($officeData['name']);
        Assert::stringNotEmpty($officeData['nameEn']);
        Assert::integer($officeData['siteId']);
        Assert::isArray($officeData['address']);
        Assert::isArray($officeData['workingTimeSchedule']);
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
        $office->id = $officeData['id'];
        $office->name = $officeData['name'];
        $office->nameEn = $officeData['nameEn'];
        $office->siteId = $officeData['siteId'];
        $office->address = OfficeAddress::fromArray($officeData['address']);
        $office->openingSchedule = OpeningSchedule::fromArray($officeData);
        $office->workingTimeSchedule = WorkingTimeSchedule::fromArray($officeData);
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
