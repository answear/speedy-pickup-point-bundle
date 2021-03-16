<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Request;

abstract class Request
{
    private string $userName;
    private string $password;
    private string $language;
    private ?int $clientSystemId;

    abstract public function getEndpoint(): string;

    abstract public function getMethod(): string;

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getClientSystemId(): int
    {
        return $this->clientSystemId;
    }

    public function setClientSystemId(?int $clientSystemId): void
    {
        $this->clientSystemId = $clientSystemId;
    }
}
