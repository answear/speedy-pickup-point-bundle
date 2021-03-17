<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit;

use Answear\SpeedyBundle\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    /**
     * @test
     */
    public function gettersAreValid(): void
    {
        $configuration = new ConfigProvider('1username', '2password', '3language', 4);

        $this->assertSame('1username', $configuration->getUsername());
        $this->assertSame('2password', $configuration->getPassword());
        $this->assertSame('3language', $configuration->getLanguage());
        $this->assertSame(4, $configuration->getClientSystemId());
        $this->assertSame('https://api.speedy.bg/', $configuration->getUrl());
        $this->assertSame('v1', $configuration->getApiVersion());
    }
}
