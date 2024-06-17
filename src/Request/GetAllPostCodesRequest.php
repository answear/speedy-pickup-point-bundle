<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Request;

class GetAllPostCodesRequest extends Request
{
    private const ENDPOINT = '/location/postcode/csv';
    private const HTTP_METHOD = 'POST';

    private int $countryId;

    public function __construct(int $countryId)
    {
        $this->countryId = $countryId;
    }

    public function getEndpoint(): string
    {
        return self::ENDPOINT . '/' . $this->countryId;
    }

    public function getMethod(): string
    {
        return self::HTTP_METHOD;
    }
}
