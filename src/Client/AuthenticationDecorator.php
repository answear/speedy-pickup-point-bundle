<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Client;

use Answear\SpeedyBundle\ConfigProvider;
use Answear\SpeedyBundle\Request\Request;

class AuthenticationDecorator
{
    public function __construct(private ConfigProvider $configuration)
    {
    }

    public function decorate(Request $request): void
    {
        $request->userName = $this->configuration->username;
        $request->password = $this->configuration->password;
        $request->language = $this->configuration->language;
        $request->clientSystemId = $this->configuration->clientSystemId;
    }
}
