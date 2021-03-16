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

    public int $id;
    public string $name;
    public string $nameEn;
    public int $siteId;
    public OfficeAddress $address;
    public WorkingTime $workingTime;
    public ParcelDimension $maxParcelDimension;
    public float $maxParcelWeight;
    public OfficeType $type;
    public int $nearbyOfficeId;
    public bool $palletOffice;
    public bool $cardPaymentAllowed;
    public bool $cashPaymentAllowed;
    public \DateTimeInterface $validFrom;
    public \DateTimeInterface $validTo;
    /** @var CargoType[] */
    public array $cargoTypesAllowed;
    public bool $pickUpAllowed;
    public bool $dropOffAllowed;

    public function __construct(int $id, string $name, string $nameEn, int $siteId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->nameEn = $nameEn;
        $this->siteId = $siteId;
    }

    public static function fromArray(array $officeData): self
    {
        Assert::integer($officeData[static::ID]);
        Assert::stringNotEmpty($officeData[static::NAME]);
        Assert::stringNotEmpty($officeData[static::NAME_EN]);
        Assert::integer($officeData[static::SITE_ID]);

        return new self(
            $officeData[static::ID],
            $officeData[static::NAME],
            $officeData[static::NAME_EN],
            $officeData[static::SITE_ID]
        );
    }
}
