<?php

declare(strict_types=1);

namespace Answear\SpeedyBundle\Tests\Unit;

use Answear\SpeedyBundle\ConfigProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    #[Test]
    public function gettersAreValid(): void
    {
        $configuration = new ConfigProvider('1username', '2password', '3language', '4');

        $this->assertSame('1username', $configuration->username);
        $this->assertSame('2password', $configuration->password);
        $this->assertSame('3language', $configuration->language);
        $this->assertSame(4, $configuration->clientSystemId);
        $this->assertSame('https://api.speedy.bg/', $configuration->getUrl());
        $this->assertSame('v1', $configuration->getApiVersion());
    }
}
