<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests;

use Answear\SpeedyBundle\ConfigProvider;

trait ConfigProviderTrait
{
    public function getConfiguration(): ConfigProvider
    {
        return new ConfigProvider('username', 'password', 'language', 999);
    }
}
