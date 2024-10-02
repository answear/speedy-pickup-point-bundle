<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Answear\SpeedyBundle\Response\Struct\Site;
use Answear\SpeedyBundle\Response\Struct\SiteCollection;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

readonly class GetAllSitesResponse
{
    public function __construct(public SiteCollection $sites)
    {
    }

    public static function fromCsv(string $csv): self
    {
        $serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], [new CsvEncoder()]);

        $sites = $serializer->deserialize($csv, Site::class . '[]', CsvEncoder::FORMAT);

        return new self(
            new SiteCollection($sites)
        );
    }
}
