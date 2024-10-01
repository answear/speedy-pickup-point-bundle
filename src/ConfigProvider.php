<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle;

class ConfigProvider
{
    private const URL = 'https://api.speedy.bg/';
    private const API_VERSION = 'v1';

    public readonly ?int $clientSystemId;

    public function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly string $language,
        ?string $clientSystemId = null,
    ) {
        $this->clientSystemId = empty($clientSystemId) || !\is_numeric($clientSystemId) ? null : (int) $clientSystemId;
    }

    public function getUrl(): string
    {
        return self::URL;
    }

    public function getApiVersion(): string
    {
        return self::API_VERSION;
    }
}
