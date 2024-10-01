<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Request;

abstract class Request
{
    public string $userName;
    public string $password;
    public string $language;
    public ?int $clientSystemId;

    abstract public function getEndpoint(): string;

    abstract public function getMethod(): string;
}
