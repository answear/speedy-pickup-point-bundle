<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Answear\SpeedyBundle\Response\Struct\PostCode;
use Answear\SpeedyBundle\Response\Struct\PostCodeCollection;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class GetAllPostCodesResponse
{
    public PostCodeCollection $postCodes;

    public function __construct(PostCodeCollection $postCodes)
    {
        $this->postCodes = $postCodes;
    }

    public function getPostCodes(): PostCodeCollection
    {
        return $this->postCodes;
    }

    public static function fromCsv(string $csv): self
    {
        $serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], [new CsvEncoder()]);

        $postCodes = $serializer->deserialize($csv, PostCode::class . '[]', CsvEncoder::FORMAT);

        return new self(
            new PostCodeCollection($postCodes)
        );
    }
}
