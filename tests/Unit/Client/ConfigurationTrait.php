<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit\Client;

use Answear\SpeedyBundle\ConfigProvider;

trait ConfigurationTrait
{
    public function getConfiguration(): ConfigProvider
    {
        return new ConfigProvider('username', 'password', 'language', 999);
    }
}
