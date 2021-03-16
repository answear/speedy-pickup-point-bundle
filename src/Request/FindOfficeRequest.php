<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Request;

class FindOfficeRequest extends Request
{
    private const ENDPOINT = '/location/office';
    private const HTTP_METHOD = 'POST';

    private ?int $countryId;
    private ?int $siteId;
    private ?string $name;
    private ?int $limit;

    public function __construct(?int $countryId = null, ?int $siteId = null, ?string $name = null, ?int $limit = null)
    {
        $this->countryId = $countryId;
        $this->siteId = $siteId;
        $this->name = $name;
        $this->limit = $limit;
    }

    public function getEndpoint(): string
    {
        return static::ENDPOINT;
    }

    public function getMethod(): string
    {
        return static::HTTP_METHOD;
    }
}
