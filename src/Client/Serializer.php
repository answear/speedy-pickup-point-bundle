<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Client;

use Answear\SpeedyBundle\Request\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

class Serializer
{
    private const FORMAT = 'json';

    private SymfonySerializer $serializer;

    public function serialize(Request $request): string
    {
        return $this->getSerializer()->serialize(
            $request,
            self::FORMAT,
            [Normalizer\AbstractObjectNormalizer::SKIP_NULL_VALUES => true]
        );
    }

    private function getSerializer(): SymfonySerializer
    {
        if (!isset($this->serializer)) {
            $this->serializer = new SymfonySerializer(
                [new Normalizer\PropertyNormalizer()],
                [new JsonEncoder()]
            );
        }

        return $this->serializer;
    }
}
