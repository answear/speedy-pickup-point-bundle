<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle;

class ConfigProvider
{
    private const URL = 'https://api.speedy.bg/';
    private const API_VERSION = 'v1';
    private string $username;
    private string $password;
    private string $language;
    private ?int $clientSystemId;

    public function __construct(string $username, string $password, string $language, ?int $clientSystemId = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->language = $language;
        $this->clientSystemId = $clientSystemId;
    }

    public function getUrl(): string
    {
        return static::URL;
    }

    public function getApiVersion(): string
    {
        return static::API_VERSION;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getClientSystemId(): ?int
    {
        return $this->clientSystemId;
    }
}
