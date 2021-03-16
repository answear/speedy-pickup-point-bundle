<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Client;

use Answear\SpeedyBundle\ConfigProvider;
use Answear\SpeedyBundle\Request\Request;

class AuthenticationDecorator
{
    private ConfigProvider $configuration;

    public function __construct(ConfigProvider $configuration)
    {
        $this->configuration = $configuration;
    }

    public function decorate(Request $request): void
    {
        $request->setUserName($this->configuration->getUsername());
        $request->setPassword($this->configuration->getPassword());
        $request->setLanguage($this->configuration->getLanguage());
        $request->setClientSystemId($this->configuration->getClientSystemId());
    }
}
