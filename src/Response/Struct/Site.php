<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response\Struct;

class Site
{
    public int $id;
    public int $countryId;
    public int $mainSiteId;
    public string $type;
    public string $typeEn;
    public string $name;
    public string $nameEn;
    public string $municipality;
    public string $municipalityEn;
    public string $region;
    public string $regionEn;
    public string $postCode;
    public int $addressNomenclature;
    public float $x;
    public float $y;
    public string $servingDays;
    public int $servingOfficeId;
    public int $servingHubOfficeId;
}
