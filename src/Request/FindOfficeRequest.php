<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Request;

class FindOfficeRequest extends Request
{
    private const ENDPOINT = '/location/office';
    private const HTTP_METHOD = 'POST';

    public function __construct(
        private ?int $countryId = null,
        private ?int $siteId = null,
        private ?string $name = null,
        private ?int $limit = null,
    ) {
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT;
    }

    public function getMethod(): string
    {
        return self::HTTP_METHOD;
    }
}
