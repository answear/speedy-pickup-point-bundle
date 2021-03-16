<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Response;

use Webmozart\Assert\Assert;

class ErrorResponse
{
    private const ERROR = 'error';
    private const ERROR_MESSAGE = 'message';
    private const ERROR_ID = 'id';
    private const ERROR_CODE = 'code';
    private const ERROR_CONTEXT = 'context';
    private const ERROR_COMPONENT = 'component';

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
        return isset($response[static::ERROR]);
    }

    public static function fromArray(array $response): self
    {
        if (!static::isErrorResponse($response)) {
            throw new \RuntimeException('Cannot create ErrorResponse');
        }

        $response = $response[static::ERROR];

        Assert::keyExists($response, static::ERROR_MESSAGE);
        Assert::keyExists($response, static::ERROR_ID);
        Assert::keyExists($response, static::ERROR_CODE);

        return new self(
            $response[static::ERROR_MESSAGE],
            $response[static::ERROR_ID],
            (int) $response[static::ERROR_CODE],
            $response[static::ERROR_CONTEXT] ?? null,
            $response[static::ERROR_COMPONENT] ?? null,
        );
    }
}
