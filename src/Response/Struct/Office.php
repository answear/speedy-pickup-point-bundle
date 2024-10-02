<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

use Answear\SpeedyBundle\Enum\CargoType;
use Answear\SpeedyBundle\Enum\OfficeType;
use Webmozart\Assert\Assert;

readonly class Office
{
    /**
     * @param CargoType[] $cargoTypesAllowed
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $nameEn,
        public int $siteId,
        public OfficeAddress $address,
        public OpeningSchedule $openingSchedule,
        public WorkingTimeSchedule $workingTimeSchedule,
        public ShipmentParcelSize $maxParcelDimension,
        public float $maxParcelWeight,
        public OfficeType $type,
        public ?int $nearbyOfficeId,
        public bool $palletOffice,
        public bool $cardPaymentAllowed,
        public bool $cashPaymentAllowed,
        public \DateTimeInterface $validFrom,
        public \DateTimeInterface $validTo,
        public array $cargoTypesAllowed,
        public bool $pickUpAllowed,
        public bool $dropOffAllowed,
    ) {
    }

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

        return new self(
            $officeData['id'],
            $officeData['name'],
            $officeData['nameEn'],
            $officeData['siteId'],
            OfficeAddress::fromArray($officeData['address']),
            OpeningSchedule::fromArray($officeData),
            WorkingTimeSchedule::fromArray($officeData),
            ShipmentParcelSize::fromArray($officeData['maxParcelDimensions']),
            $officeData['maxParcelWeight'],
            OfficeType::from($officeData['type']),
            $officeData['nearbyOfficeId'] ?? null,
            $officeData['palletOffice'],
            $officeData['cardPaymentAllowed'],
            $officeData['cashPaymentAllowed'],
            new \DateTimeImmutable($officeData['validFrom']),
            new \DateTimeImmutable($officeData['validTo']),
            array_map(static fn($type) => CargoType::from($type),
                $officeData['cargoTypesAllowed']
            ),
            $officeData['pickUpAllowed'],
            $officeData['dropOffAllowed'],
        );
    }
}
