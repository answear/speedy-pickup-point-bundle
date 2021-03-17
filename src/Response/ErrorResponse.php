<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Webmozart\Assert\Assert;

class ErrorResponse
{
    public string $message;
    public string $id;
    public int $code;
    public ?string $context;
    public ?string $component;

    public function __construct(
        string $message,
        string $id,
        int $code,
        ?string $context = null,
        ?string $component = null
    ) {
        $this->message = $message;
        $this->id = $id;
        $this->code = $code;
        $this->context = $context;
        $this->component = $component;
    }

    public static function isErrorResponse(array $response): bool
    {
        return isset($response['error']);
    }

    public static function fromArray(array $response): self
    {
        if (!static::isErrorResponse($response)) {
            throw new \RuntimeException('Cannot create ErrorResponse');
        }

        $response = $response['error'];

        Assert::keyExists($response, 'message');
        Assert::keyExists($response, 'id');
        Assert::keyExists($response, 'code');

        return new self(
            $response['message'],
            $response['id'],
            (int) $response['code'],
            $response['context'] ?? null,
            $response['component'] ?? null,
        );
    }
}
