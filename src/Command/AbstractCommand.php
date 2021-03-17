<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Command;

use Answear\SpeedyBundle\Exception\MalformedResponseException;
use Answear\SpeedyBundle\Response\ErrorResponse;
use Psr\Http\Message\ResponseInterface;
use Webmozart\Assert\Assert;

abstract class AbstractCommand
{
    protected function getBody(ResponseInterface $response): array
    {
        try {
            $body = $response->getBody()->getContents();

            if (empty($body)) {
                throw new \RuntimeException('Empty response.');
            }
            $decoded = \json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            Assert::isArray($decoded);
        } catch (\Throwable $e) {
            throw new MalformedResponseException($e->getMessage(), $response, $e);
        }

        if (ErrorResponse::isErrorResponse($decoded)) {
            throw new MalformedResponseException('Error response', ErrorResponse::fromArray($decoded));
        }

        return $decoded;
    }
}
